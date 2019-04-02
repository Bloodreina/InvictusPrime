e == 'posix':
            self.finalize_unix()
        else:
            self.finalize_other()

        self.dump_dirs("post-finalize_{unix,other}()")

        # Expand configuration variables, tilde, etc. in self.install_base
        # and self.install_platbase -- that way, we can use $base or
        # $platbase in the other installation directories and not worry
        # about needing recursive variable expansion (shudder).

        py_version = (string.split(sys.version))[0]
        (prefix, exec_prefix) = get_config_vars('prefix', 'exec_prefix')
        self.config_vars = {'dist_name': self.distribution.get_name(),
                            'dist_version': self.distribution.get_version(),
                            'dist_fullname': self.distribution.get_fullname(),
                            'py_version': py_version,
                            'py_version_short': py_version[0:3],
                            'py_version_nodot': py_version[0] + py_version[2],
                            'sys_prefix': prefix,
                            'prefix': prefix,
                            'sys_exec_prefix': exec_prefix,
                            'exec_prefix': exec_prefix,
                            'userbase': self.install_userbase,
                            'usersite': self.install_usersite,
                           }
        self.expand_basedirs()

        self.dump_dirs("post-expand_basedirs()")

        # MSYS (probably) will have transformed --root=/ to the
        # windows path where the msys is installed, so we check if root begins
        # with msysroot and if it does then remove this part.
        if self.root is not None and is_msys_mingw():
            msysroot = msys_root()
            if msysroot != None and self.root.find(msysroot)==0:
                self.root = self.root.replace(msysroot, "/")

        # Now define config vars for the base directories so we can expand
        # everything else.
        self.config_vars['base'] = self.install_base
        self.config_vars['platbase'] = self.install_platbase

        if DEBUG:
            from pprint import pprint
            print "config vars:"
            pprint(self.config_vars)

        # Expand "~" and configuration variables in the installation
        # directories.
        self.expand_dirs()

        s
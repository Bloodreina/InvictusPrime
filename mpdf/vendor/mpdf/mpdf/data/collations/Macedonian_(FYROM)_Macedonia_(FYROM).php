# Distributed under the OSI-approved BSD 3-Clause License.  See accompanying
# file Copyright.txt or https://cmake.org/licensing for details.

#.rst:
# CheckPrototypeDefinition
# ------------------------
#
# Check if the prototype we expect is correct.
#
# check_prototype_definition(FUNCTION PROTOTYPE RETURN HEADER VARIABLE)
#
# ::
#
#   FUNCTION - The name of the function (used to check if prototype exists)
#   PROTOTYPE- The prototype to check.
#   RETURN - The return value of the function.
#   HEADER - The header files required.
#   VARIABLE - The variable to store the result.
#              Will be created as an internal cache variable.
#
# Example:
#
# ::
#
#   check_prototype_definition(getpwent_r
#    "struct passwd *getpwent_r(struct passwd *src, char *buf, int buflen)"
#    "NULL"
#    "unistd.h;pwd.h"
#    SOLARIS_GETPWENT_R)
#
# The following variables may be set before calling this macro to modify
# the way the check is run:
#
# ::
#
#   CMAKE_REQUIRED_FLAGS = string of compile command line flags
#   CMAKE_REQUIRED_DEFINITIONS = list of macros to define (-DFOO=bar)
#   CM
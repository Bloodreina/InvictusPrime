<?php 

	class Usuario{
		private $codUsuario;
		private $email;
		private $senha;
		private $nick;
		private $autenticacao;
		private $areaAtuacao;
		private $fotoUsuario;

		public function __construct($nick = "", $email = "", $senha = "", $areaAtuacao = "", $autenticacao = ""){
			$this->setNick($nick);
			$this->setEmail($email);
			$this->setSenha($senha);
			$this->setAreaAtuacao($areaAtuacao);
			$this->setAutenticacao($autenticacao);
		}

		public function getCodUsuario(){
			return $this->codUsuario;
		}
		public function setCodUsuario($valor){
			$this->codUsuario = $valor;
		}
		public function getEmail(){
			return $this->email;
		}
		public function setEmail($valor){
			$this->email = $valor;
		}
		public function getSenha(){
			return $this->senha;
		}
		public function setSenha($valor){
			$this->senha = $valor;
		}
		public function getNick(){
			return $this->nick;
		}
		public function setNick($valor){
			$this->nick = $valor;
		}
		public function getAreaAtuacao(){
			return $this->areaAtuacao;
		}
		public function setAreaAtuacao($valor){
			$this->areaAtuacao = $valor;
		}
		public function getAutenticacao(){
			return $this->autenticacao;
		}
		public function setAutenticacao($valor){
			$this->autenticacao = $valor;
		}
		public function getFotoUsuario(){
			return $this->fotoUsuario;
		}
		public function setFotoUsuario($valor){
			$this->fotoUsuario = $valor;
		}

		private function setData($dados){
			$this->setCodUsuario($dados['COD_USUARIO']);
			$this->setEmail($dados['EMAIL_USUARIO']);
			$this->setSenha($dados['SENHA_USUARIO']);
			$this->setNick($dados['NICKNAME']);
			$this->setAutenticacao($dados['AUTENTICACAO']);
			$this->setFotoUsuario($dados['FOTO_USUARIO']);
		}

		public function loadById($id){
			$sql = new Sql();

			$resultado = $sql->select("SELECT * FROM usuario WHERE COD_USUARIO = :ID", array(
				":ID"=>$id
				));

			$this->buscarAreaAtuacao($id);

			if(count($resultado) > 0){
				$this->setData($resultado[0]);
			}
		}

		public function login($email, $senha){
			$sql = new Sql();

			$resultado = $sql->select("SELECT * FROM usuario WHERE EMAIL_USUARIO = :EMAIL AND SENHA_USUARIO = :SENHA", array(
				":EMAIL"=>$email,
				":SENHA"=>sha1($senha)
				));

			if(count($resultado) > 0){
				$this->setData($resultado[0]);

				return $resultado;
			}
			else{
				//throw new Exception("Login e/ou senha invalidos!");
				return false;
			}
		}

		public function register(){
		 	$sql = new Sql();

		 	$verifica = $sql->select("SELECT * FROM usuario WHERE EMAIL_USUARIO = :EMAIL", array(
		 		":EMAIL"=>$this->getEmail()
		 		));

		 	if(count($verifica) >= 1){
		 		echo "E-mail já cadastrado!";
		 	}else{
			 	$resultado = $sql->select("CALL SP_INS_REGISTRA_USUARIO(:NICK, :EMAIL, :SENHA)", array(
			 		":NICK"=>$this->getNick(),
			 		":EMAIL"=>$this->getEmail(),
			 		":SENHA"=>sha1($this->getSenha())
			 		));


			 	if(count($resultado) > 0){
			 		$this->setData($resultado[0]);

			 		$this->areaAtuacaoUsuario();

			 	}else{
			 		//throw new Exception("Login e/ou senha invalidos!");
					echo "Não foi possivel fazer o cadastro!";
			 	}
			 }
		}
		private function areaAtuacaoUsuario(){
			$sql = new Sql();

			$sql->query("CALL SP_INS_AREAATUACAO_USUARIO(:CODUSUARIO, :AREAATUACAO)", array(
						":CODUSUARIO"=>$this->getCodUsuario(),
						":AREAATUACAO"=>$this->getAreaAtuacao()
						));
		}

		public function geraChaveAcesso($email){
			$sql = new Sql();

			$gerar = $sql->select("SELECT * FROM usuario WHERE EMAIL_USUARIO = :EMAIL", array(
				":EMAIL"=>$email
				));
			if(count($gerar) > 0){
				@$chave = sha1($gerar["COD_USUARIO"].$gerar["SENHA_USUARIO"]);
				return $chave;
			}else{
				echo "E-mail não encontrado!";
			}
		}

		public function checkChave($email, $chave){
			$sql = new Sql();

			$checkar = $sql->select("SELECT * FROM usuario WHERE EMAIL_USUARIO = :EMAIL", array(
				":EMAIL"=>$email
				));

			if(count($checkar) > 0){

				$this->setData($checkar[0]);

				@$chaveCorreta = sha1($checkar['COD_USUARIO'].$checkar['SENHA_USUARIO']);
				if($chave === $chaveCorreta){
					return $this->getCodUsuario();
				}
			}
		}

		public function update($COD, $senha){
			$sql = new Sql();

			$sql->select("CALL SP_UP_SENHA_USUARIO(:CODUSUARIO, :SENHA)", array(
				":SENHA"=>sha1($senha),
				":CODUSUARIO"=>$COD
				));
			
		}
		public function buscarAreaAtuacao($codUsuario){
			$sql = new Sql();

			$resultado = $sql->query("SELECT * FROM area_atuacao INNER JOIN areaatuacao_usuario
									  ON area_atuacao.COD_AREA = areaatuacao_usuario.COD_AREA
									  WHERE areaatuacao_usuario.COD_USUARIO = :CODUSUARIO", array(
									  ":CODUSUARIO"=>$codUsuario
									));
			if(isset($resultado)){
				$resultado = $resultado->fetch(PDO::FETCH_ASSOC);
				$this->setAreaAtuacao($resultado['NOME_AREA']);
			}
		}
		public function atualizaPerfil($codUsuario, $nickName, $emailUsuario, $senha, $areaAtuacao){
			$sql = new Sql();

			$sql->query("CALL SP_UP_USUARIO(:CODUSUARIO, :NICK, :EMAIL, :SENHA)", array(
					":CODUSUARIO"=>$codUsuario,
					":NICK"=>$nickName,
					":EMAIL"=>$emailUsuario,
					":SENHA"=>sha1($senha)
					));
			$sql->query("UPDATE areaatuacao_usuario SET COD_AREA = :CODAREA WHERE COD_USUARIO = :CODUSUARIO", array(
						":CODAREA"=>$areaAtuacao,
						":CODUSUARIO"=>$codUsuario
					));
		}

		public function uploadFotoUsuario($nomeArquivo, $codUsuario){
			$sql = new Sql();

			$pasta = "fotoUsuario" . DIRECTORY_SEPARATOR;
			$foto = "";
			$nome = "";

			$file = $nomeArquivo['tmp_name'];

			list($oldWidth, $oldHeight) = getimagesize($file);

			$newWidth = 200;
			$newHeight = 200;

			/*if($oldWidth > $oldHeight){
				$newHeight = ($newWidth/$oldWidth) * $oldHeight;
			}elseif($oldWidth < $oldHeight){
				$newWidth = ($newHeight/$oldHeight) * $oldWidth;
			}*/

			$newImage = imagecreatetruecolor($newWidth, $newHeight);
			$oldImage = imagecreatefromjpeg($file);

			imagecopyresampled($newImage , $oldImage, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);

			imagejpeg($newImage, $file);

			imagedestroy($newImage);
			imagedestroy($oldImage);
			

			$novo_nome = sha1(time().$nomeArquivo['size']);
			$nome = $pasta.$novo_nome.".jpg";

			move_uploaded_file($file, $nome);

			$sql->query("UPDATE usuario SET FOTO_USUARIO = :CAMINHO WHERE COD_USUARIO = :CODUSUARIO", array(
						":CAMINHO"=>$nome,
						":CODUSUARIO"=>$codUsuario
						));
		}

	}

 ?>
<?php
date_default_timezone_set('America/Sao_paulo');
session_start();
require_once("../model/recordset.php");
require_once("../class/class.functions.php");
date_default_timezone_set("America/Sao_Paulo");
$fn = new functions(); 
$rs = new recordset();
extract($_POST);
$resul = array(); 
$res = array();
$dados = array();
//-------------------------------------------------------------------------------------------------------------------------
/////////FUNÇÔES DO SYSTEMA /////////////////////////////////////////////////////////////////////////////////////////////||
//=========================================================================================================================

//-------------------------------------------------------------------------------------------------------
//EMPRESA /////////////////////////////////////////////////////////////////////////////////////////////||
//=======================================================================================================

	/*---------------|FUNCAO PARA CADASTRAR A EMPRESA|--------------\
	|												   				|
	\--------------------------------------------------------------*/

	if($acao == "Cadastra_Empresa"){
		$logo ="/images/logo_emp/default-logo.png";
		//Busca informação no bando se o nome já exixte
			$rs->seleciona("emp_cnpj","sys_empresa","emp_cnpj='{$emp_cnpj}'");
			if($rs->linhas<>0){
				$resul['status'] = "Erro";
				$resul['status'] = "CNPJ j&aacute; cadastrado";
				$resul['mensagem'] = $rs->sql;  
			}
			ELSE{	
				$cod = $rs->autocod("emp_id","sys_empresa");
				$dados['emp_id']        = $cod;
				$dados["emp_nome"]	    = $emp_nome; 
				$dados["emp_alias"] 	= $emp_alias; 
				$dados["emp_cnpj"]   	= $emp_cnpj;
				$dados["emp_ie"]	    = $emp_ie; 
				$dados["emp_cep"]	    = $cep;   
				$dados["emp_log"]	    = $log;
				$dados["emp_num"]	    = $num;   
				$dados["emp_compl"]	    = $compl;   
				$dados["emp_bai"]	    = $bai;   
				$dados["emp_cid"]	    = $cid;   
				$dados["emp_uf"]	    = $uf;   
				$dados["emp_contato"]	= $emp_contato; 
				$dados["emp_email"]	    = $emp_email; 
				$dados["emp_tel"]		= $emp_tel; 
				$dados["emp_site"]		= $emp_site;   
				$dados["emp_logo"]		= $logo;   
				$dados["emp_data"]		= $fn->data_usa($emp_data);   
														
				if(!$rs->Insere($dados,"sys_empresa")){
					$resul['status'] = "OK";
					$resul['mensagem'] = "Empresa cadastrada com sucesso!";
				}
				else{
					$resul['status'] = "Erro";
					$resul['mensagem'] = $rs->sql;
					}
				}
		
		echo json_encode($resul);
		exit;
	}
/*---------------|FIM DO CADASTRO|--------------------------------*/	

    /*-----------------|FUNCAO PARA EDITAR A EMPRESA|---------------\
	|												   				|
	\--------------------------------------------------------------*/ 

	if($acao == "Edita_Empresa"){
		$dados['emp_nome']		= $emp_nome; 	
		$dados['emp_alias']		= $emp_alias;	
		$dados['emp_cnpj']		= $emp_cnpj;
		$dados['emp_ie']	    = $emp_ie; 
		$dados['emp_cep']	    = $cep;   
		$dados['emp_log']	    = $log;
		$dados['emp_num']	    = $num;   
		$dados['emp_compl']	    = $compl;   
		$dados['emp_bai']	    = $bai;   
		$dados['emp_cid']	    = $cid;   
		$dados['emp_uf']	    = $uf;   
		$dados['emp_contato']	= $emp_contato; 
		$dados['emp_email']	    = $emp_email; 
		$dados['emp_tel']		= $emp_tel; 
		$dados['emp_site']		= $emp_site; 
		$dados['emp_data']		= $fn->data_usa($emp_data);	; 
		$whr = "emp_id=".$emp_id; 
		
		if(!$rs->Altera($dados, "sys_empresa",$whr)){ 
			$resul['status'] = "OK";
			$resul['mensagem'] = "Empresa atualizada!"; 		  
		}
		else{
			$resul['mensagem']	= "Ocorreu um erro..."; 
			$resul['sql']		= $rs->sql;  
			}	
		echo json_encode($resul);
		exit;
	}	
/*---------------|FIM DO EDITAR|---------------------------------*/	

/*-------------|FUNCAO PARA EXCLUIR EMPRESA|--------------------\
|												   				|
\--------------------------------------------------------------*/ 
	
	if($acao == "excluir_empresa"){     	
		if(!$rs->Exclui("sys_empresa","emp_id=".$emp_id)){  
			$resul['status'] = "OK";
			$resul['mensagem'] = "Dados Excluidos!"; 			  
		}
		else{
			$resul['mensagem']	= "Ocorreu um erro..."; 
			$resul['sql']		= $rs->sql;  
		}	
		echo json_encode($resul);
		exit;
	}

/*---------------|FIM DE EXLUIR EMPRESA	|------------------*/


//|----------------------------------------------------------------\
///////////////// FIM EMPRESA \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\|                                       
//|----------------------------------------------------------------/


//-------------------------------------------------------------------------------------------------------
//DEPARTAMENTO //////////////////////////////////////////////////////////////////////////////////////////
//=======================================================================================================
	
	/*-----|FUNCAO PARA CADASTRO DE DEPARTAMENTO|---------------\
	| 														    |	
	\*---------------------------------------------------------*/
	
	if($acao == "Cadastrar_Departamento"){  
		$sql ="SELECT dp_nome FROM sys_departamento a
			JOIN sys_empresa b ON b.emp_id = a.dp_empId
			WHERE dp_nome = '".$dp_nome."'And dp_empId=".$sel_emp;	
			$rs->FreeSql($sql);
			if($rs->linhas <>0){
				$resul['status'] = "Erro";
				$resul['status'] = "Nome j&aacute; cadastrado";
				$resul['mensagem'] = $rs->sql;  
			}ELSE{
			$cod = $rs->autocod("dp_id","sys_departamento");
			$dados['dp_id']     = $cod;
			$dados["dp_empId"]	= $sel_emp; 
			$dados["dp_nome"]	= $dp_nome;
		
		if(!$rs->Insere($dados,"sys_departamento")){ 
			$resul['status'] = "OK";
			$resul['mensagem'] = "Departamento cadastrado com sucesso!";
		}
		else{
			$resul['status'] = "Erro";
			$resul['mensagem'] = $rs->sql;
			
			}
		}		
		echo json_encode($resul); 
		exit;
	}
/*---------------|FIM DO CADASTRO |--------------------------------*/	

    /*------------|FUNCAO PARA EDITARR A DEPARTAMENTO|--------------\
	|												   				|
	\--------------------------------------------------------------*/ 

	if($acao == "Edita_Departamento"){
		$dados['dp_nome']	= $dp_nome;	 
		$whr = "dp_id=".$dp_id; 
		
		if(!$rs->Altera($dados, "sys_departamento",$whr)){ 
			$resul['status'] = "OK";
			$resul['mensagem'] = "Departamento atualizado!"; 
			$resul['sql'] = $rs->sql;
			  
		}
		else{
			$resul['mensagem']	= "Ocorreu um erro..."; 
			$resul['sql']		= $rs->sql;  
		}	
		echo json_encode($resul);
		exit;
	}
/*---------------|FIM DO EDITAR |-----------------------------*/	

    /*---|FUNCA PARA SELECIONAR O DP REF A EMPRESA|------------*\
	| 														    |	
	\*---------------------------------------------------------*/	 
	
	if($acao == "populaCheckDp"){
		$sql = "SELECT * FROM sys_departamento WHERE dp_empId=".$fami;
		$rs->FreeSql($sql); 
		$opt = "<option value=''>Selecione...</option>";
		while($rs->GeraDados()){
			$opt .= "<option value='".$rs->fld('dp_id')."'>".$rs->fld('dp_nome')."</option>";
		}
		echo $opt;
	}
/*---------------|FIM DA FUNCAO "populaCheckDp |------------------*/

//|----------------------------------------------------------------\
///////////////// FIM DEPARTAMENTO\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\|                                       
//|----------------------------------------------------------------/


//-------------------------------------------------------------------------------------------------------
//USUARIO ///////////////////////////////////////////////////////////////////////////////////////////////
//=======================================================================================================
	
    /*---------------|AÇÂO PARA CADASTRAR USUARIO|-------------*\
	| 														    |	
	\*---------------------------------------------------------*/
	if($acao == "Cadastra_Usuario"){
		//Define imagem por genero
		$usu_sexo ='M';// Ajustado para o Teste
		if($usu_sexo == 'M'){
			$foto ="/images/perfil/masc.jpg";
		}
		ELSE{
			$foto ="/images/perfil/fem.jpg";
			}
			//Busca informação no bando se o nome já exixte
			$rs->seleciona("usu_email","sys_usuario","usu_email='{$usu_email}'");
		if($rs->linhas<>0){
			$resul['status'] = "Erro";
			$resul['status'] = "Nome j&aacute; cadastrado";
			$resul['mensagem'] = $rs->sql;  
		}ELSE{	
				$cod = $rs->autocod("usu_cod","sys_usuario");
				$dados['usu_cod']       = $cod;
				$dados["usu_nome"] 		= $usu_nome;
				$dados["usu_email"]	    = $usu_email; 
				$dados["usu_senha"] 	= trim(md5($usu_senha));
				$dados["usu_empId"] 	= $sel_emp ; 
				$dados["usu_dpId"] 	    = $sel_dp ;
				$dados["usu_classeId"] 	= $sel_class;				
				$dados["usu_chapa"]    	= $usu_chapa;
				$dados["usu_ramal"] 	= $usu_ramal;
				$dados["usu_cel"] 	   	= $usu_cel;		
				$dados['usu_foto']	    = $foto ;  
				$dados["usu_ativo"] 	= "1";				
				$dados["usu_sexo"] 	    = "M";
				$dados["usu_online"] 	= "0";
				$dados["usu_dashId"]	= "1"; 
				$dados["usu_mnutopId"]	= "7"; 
				$dados["usu_pagId"]		= "10"; 
				$dados["usu_datacad"]   = date("Y-m-d H:i:s");
				$dados["usu_usucadId"] 	= $_SESSION['usu_cod']; 
				
				if(!$rs->Insere($dados,"sys_usuario")){
					$resul['status'] = "OK";
					$resul['mensagem'] = "Usuario cadastrado com sucesso!";
				}
				else{ 
					$resul['status'] = "Erro";
					$resul['mensagem'] = $rs->sql;
				}
			}
		echo json_encode($resul);
		exit; 
	}
/*---------------|FIM CADASTRO|------------------------------------*/	

	/*-----------|FUNCAO PARA EDITAR USUARIO ATIVO|-----------------\
	|												   				|
	\--------------------------------------------------------------*/ 

	if($acao == "Edita_Usuario"){
		$dados["usu_nome"]	    = $usu_nome;  
		$dados["usu_email"]	    = $usu_email; 
		$dados["usu_empId"]	    = $sel_emp;
		$dados["usu_dpId"]	    = $sel_dp;	   
		$dados["usu_classeId"]	= $sel_class; 			
		$dados["usu_ramal"] 	= $usu_ramal;	
		$dados["usu_cel"] 	    = $usu_cel;			
		$dados["usu_chapa"]    	= $usu_chapa;		
		$dados["usu_ativo"]	    = $usu_ativo; 
		$dados["usu_pmail"]	    = $usu_pmail; 
		$dados["usu_pchat"]	    = $usu_pchat; 
		$dados["usu_pcalend"]   = $usu_pcalend; 
		$dados["usu_prelatorio"]= $usu_prelatorio; 
		$dados["usu_sexo"]	    = $usu_sexo; 	
		$whr = "usu_cod=".$usucod; 
		
		if(!$rs->Altera($dados, "sys_usuario",$whr)){
				$resul["status"] = "OK";
				$resul["mensagem"] = "Dados Alterados!";
				$resul["sql"] = $rs->sql;
			} else {
				$resul["status"] = "ERRO";
				$resul["mensagem"] = "Falha no envio";
				$resul["sql"] = $rs->sql; 
			}	
		echo json_encode($resul); 
		exit; 
	}
/*---------------|FIM DO EDITAR|-----------------------------------*/	

	/*-------------|FUNCAO PARA EXCLUIR USUARIO|--------------------\
	|												   				|
	\--------------------------------------------------------------*/ 
	
	if($acao == "excluir_usuario"){     	
		if(!$rs->Exclui("sys_usuario","usu_cod=".$usu_cod)){  
			$resul['status'] = "OK";
			$resul['mensagem'] = "Dados Excluidos!"; 			  
		}
		else{
			$resul['mensagem']	= "Ocorreu um erro..."; 
			$resul['sql']		= $rs->sql;  
		}	
		echo json_encode($resul);
		exit;
	}

/*---------------|FIM DE EXLUIR USUARIO	|------------------*/


    /*---------------|EDITAR DE SENHA DO USUÁRIO ------------------*\
	| 																|
	\*-------------------------------------------------------------*/

	if($acao == "Edita_Senha"){
			$dados["usu_senha"] = md5($nsenha);
			$whr = "usu_cod=".$usucod; 
			
			if(!$rs->Altera($dados, "sys_usuario",$whr)){
				$resul["status"] = "OK";
				$resul["mensagem"] = " OK!";
				$resul["sql"] = $rs->sql;
			} else {
				$resul["status"] = "ERRO";
				$resul["mensagem"] = "Falha no envio";
				$resul["sql"] = $rs->sql; 
			}			
		echo json_encode($resul);
		exit;
	}
/*---------------|FIM EDITAR|------------------------------------*\


//|----------------------------------------------------------------\
///////////////// FIM USUARIO \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\|                                       
//|----------------------------------------------------------------/


//-------------------------------------------------------------------------------------------------------
//PERFIL DE USUARIO//////////////////////////////////////////////////////////////////////////////////////
//=======================================================================================================

	/*---------------|EDITAR  PERFIL|------------------------------*\
	| 																|
	\*-------------------------------------------------------------*/

	if($acao == "Edita_Perfil"){
		$dados["usu_nome"]	    = $usu_nome;
		$dados["usu_ramal"] 	= $usu_ramal;	
		$dados["usu_cel"] 	    = $usu_cel;			
		$dados["usu_chapa"]    	= $usu_chapa;			
		$dados["usu_dashId"]	= $cor;	
		$dados["usu_pagId"] 	= $corpag;	
		$dados["usu_mnutopId"]	= $cormenu;	
		
		$whr = "usu_cod=".$usu_cod; 
		if(!$rs->Altera($dados, "sys_usuario",$whr)){
				$resul["status"] = "OK";
				$resul["mensagem"] = "Dados Alterados!";
				$resul["sql"] = $rs->sql;
			} else {
				$resul["status"] = "ERRO";
				$resul["mensagem"] = "Falha no envio";
				$resul["sql"] = $rs->sql; 
			}
		 echo json_encode($resul);
		exit;
	}
/*---------------|FIM EDITAR|-------------------------------------*\

    /*---------------|EDITAR DE SENHA DO USUÁRIO ------------------*\
	| 																|
	\*-------------------------------------------------------------*/

	if($acao == "Altera_Senha"){
			$dados["usu_senha"] = md5($nsenha);
			$whr = "usu_cod =".$_SESSION['usu_cod'];
			
			if(!$rs->Altera($dados, "sys_usuario",$whr)){
				$resul["status"] = "OK";
				$resul["mensagem"] = "Senha Alterada!";
				$resul["sql"] = $rs->sql;
			} else {
				$resul["status"] = "ERRO";
				$resul["mensagem"] = "Falha no envio";
				$resul["sql"] = $rs->sql; 
			}			
		echo json_encode($resul);
		exit;
	}
/*---------------|FIM EDITAR|------------------------------------*/

//|----------------------------------------------------------------\
///////////////// FIM PERFIL USUARIO \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\|                                       
//|----------------------------------------------------------------/


//---------------------------------------------------------------------------------------------------------------------------------
/////////FIN DAS FUNÇÔES DO SYSTEMA /////////////////////////////////////////////////////////////////////////////////////////////||
//=================================================================================================================================


//-------------------------------------------------------------------------------------------------------------------------
///////// FUNÇÔES  //////////////////////////////////////////////////////////////////////////////////////////////////////||
//=========================================================================================================================


//---------------------------------------------------------------------------------------------------------------------------------
/////////FIN DAS FUNÇÔES  /////////////////////////////////////////////////////////////////////////////////////////////||||||||||||
//=================================================================================================================================

?>	
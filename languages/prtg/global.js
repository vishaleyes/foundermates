// JavaScript Document
var msg=new Array(); 
//msg[0]="<img src='"+BASHPATH+"public/images/spinner-small.gif' alt='Loading'>";   

// Validation for Sign Up Form -- Seeker

msg['FNAME_VALIDATE']="Por favor digite o primeiro nome";
msg['LNAME_VALIDATE']="Por favor digite o sobrenome";
msg['EMAIL_VALIDATE']="Por favor, especifique-mail, telefone ou ambos";
msg['VEMAIL_VALIDATE']="Por favor, especifique-mail, telefone ou ambos";
msg['SUCCESS_EMAIL_VALIDATE']="Vamos enviar um e-mail de confirmação para este endereço de e-mail";
msg['ERROR_EMAIL_VALIDATE']="Este endereço de e-mail não está disponível para registo. Por favor, especifique-mail, telefone ou ambos";
msg['PHONE_VALIDATE']="Por favor, especifique-mail ou telefone";
msg['VPHONE_VALIDATE']="não é um número de telefone válido nos EUA";
msg['APHONE_VALIDATE']="Número de telefone está disponível para registo";
msg['NAPHONE_VALIDATE']="Número de telefone não está disponível para registo";
msg['PASSWORD_VALIDATE']="Por favor, digite a senha válida";
msg['VPASSWORD_VALIDATE']="A senha deve ser maior que 6 caracteres";
msg['CPASSWORD_VALIDATE']="Por favor re-digite a senha";
msg['MPASSWORD_VALIDATE']="Senha e confirmar senha não corresponder";
msg['_OLD_NEW_VALIDATE_']="Senha antiga ea nova senha não deve ser o mesmo";
msg['LOCATION_VALIDATE']="Por favor, insira o endereço";
msg['_LOCATION_ON_SUBMIT_VALIDATE_']="Este endereço precisa ser completa.";
msg['PLOCATION_VALIDATE']="Por favor indicar localização";
msg['VLOCATION_VALIDATE']="Digite no mínimo 4 caracteres";
msg['DISTANCE_VALIDATE']="Por favor indicar distância em milhas";
msg['VDISTANCE_VALIDATE']="Distância deve ser numérico";
msg['OCCUPATION_VALIDATE']="Selecionar pelo menos uma ocupação";
msg['CONTACT_VALIDATE']="Selecionar pelo menos um tipo de comunicação";
msg['JOBTYPE_VALIDATE']="Selecionar pelo menos um tipo de trabalho";
msg['WORK_SCHEDULE_VALIDATE']="Selecionar pelo menos um tipo de agendamento";
msg['PHONE_NUMBER']="número de telefone";
msg['WORK_SHIFT_VALIDATE']="Selecionar pelo menos um tipo de mudança";
msg['LANGUAGE_VALIDATE']="Selecione pelo menos uma língua";
msg['RADIUS_VALIDATE']="Por favor digite o raio em milhas";
msg['VRADIUS_VALIDATE']="O raio deve ser numérico";
msg['VRADIUS_VALIDATE_LIMIT']="Raio deve ser positivo ou inferior a 50.";

//Add Account Manager

msg['PASSWORD_LENGTH_VALIDATE_ACCOUNTMANAGER']="Mínimo de 6 caracteres";
msg['PASSWORD_METCH_VALIDATE_ACCOUNTMANAGER']="Senhas não coincidem";
msg['PHONE_VALIDATE_ACCOUNTMANAGER']="Digite o número do telefone";
msg['PHONE_VALIDATE_NOT_VALID_ACCOUNTMANAGER']="Não é válida número dos EUA";
msg['PHONE_VALIDATE_SUCCESS_ACCOUNTMANAGER']="Disponíveis para registo";
msg['EMAIL_VALIDATE_ACCOUNT_MANAGER']="Especifique-mail, telefone ou ambos";
msg['EMAIL_VALIDATE_VALID_ERROR_ACCOUNT_MANAGER']="não é válido.";
msg['SUCCESS_EMAIL_VALIDATE_ACCOUNT_MANAGER']="Disponíveis para registo.";
msg['FNAME_VALIDATE_ACCOUNTMANAGER']="Digite o nome";
msg['LNAME_VALIDATE_ACCOUNTMANAGER']="Digite o sobrenome";
msg['PASSWORD_VALIDATE_ACCOUNTMANAGER']="Digite a senha";
msg['CPASSWORD_VALIDATE_ACCOUNTMANAGER']="Re-enter password";
msg['EMAIL_NOT_AVAILABLE_VALIDATE_ERROR']="Não disponível para registo";
msg['PHONE_NOT_AVAILABLE_VALIDATE_ERROR']="Não disponível para registo";
msg['ACCOUNT_MANAGER_CREATED_SUCCESS']="Gerente de contas criado com sucesso.";

// End Validation for Seeker

//ADD location

msg['LABEL_VALIDATE_ERROR']="Digite o nome para este endereço";
msg['ADDRESS_NEED TO_COMPLETE_ERROR']="Este endereço precisa ser completa.";

// Validation for Sign Up Form -- Employertest

msg['BNAME_VALIDATE']="Digite o nome de negócio";
msg['BADDRESS_VALIDATE']="Por favor, insira o endereço de negócios";
msg['BTYPE_VALIDATE']="Selecione pelo menos um tipo de ocupação";
msg['GOOGLE_ADDRESS_VALIDATE']="O endereço que você digitou, não parece ser accurate.Would você gosta de usar o seguinte endereço em vez disso?<br /> ";
msg['GOOGLE_BUSINESS_ADDRESS_VALIDATE']="O endereço que você digitou corresponde ao seguinte endereço. Usaremos as coordenadas GPS do seguinte endereço? <br /> ";
msg['GOOGLE_ADDRESS_ADD_VALIDATE']="Desculpe, não foi possível encontrar o endereço que você especificou. Por favor, entrar de novo.";
msg['GOOGLE_BUSINESS_ADDRESS_ADD_VALIDATE']="Por favor, especifique endereço completo para o negócio. Por favor digite novamente.";
msg['_GOOGLE_ADDRESS_SAME_VALIDATE_']="Por favor, não use o mesmo endereço.";
msg['NO_MATCHING_CANDIDATE']="Nenhum candidato ainda correspondência.";
msg['_GOOGLE_ADDRESS_VALIDATE_EMPLOYER_']="Seu endereço não combinar com o endereço google api.";
// End Validation for Employer


// Validation for Activate.tpl   --User

msg['CAPTCHA_VALIDATE_ACTIVATE']="Por favor indicar captcha válido";

// End Validation for Employer

//Employer user account 
msg['ADS']="Conta excluída com sucesso";
msg['ADE']="Erro de conta exclusão";


//Employer Location 
msg['LAS']="Localização adicionado com sucesso";

msg['LAE']="Adicionar a localização de erro";

msg['LUS']="Localização atualizados com sucesso";

msg['LUE']="Actualização de erro";

msg['PAS']="Telefone adicionado com sucesso";

msg['PAE']="Erro de adicionar telefone";

msg['PDS']="Telefone apagado com sucesso";
msg['PDE']="Erro de exclusão telefone";

msg['LDS']="Localização apagado com sucesso";
msg['LDE']="Erro de exclusão localização";

msg['LES']="Localização editado com sucesso";
msg['LEE']="Erro de edição de localização";

msg['DLCS']="Local padrão alterada com sucesso";
msg['PLCS']="Localização primária alterada com sucesso.";

//Edit Profile

msg['OCCUPATION_VALIDATE_ERROR']="Pelo menos uma ocupação";
msg['CONTACT_VALIDATE_ERROR']="Pelo menos uma preferência de comunicação";
msg['PROFILE_UPDATE']="Perfil atualizado com sucesso";

// Forgot Password
msg['FP_SUCCESS']="Senha alterada com sucesso";
msg['EMAIL_PHONE']="Por favor, indique-mail ou telefone";
msg['VEMAIL_PHONE']="Digite e-mail válido ou telefone";


//Hire Request - Seeker
msg['HR_DELETE_SUCCESS']="Contratar pedido apagado com sucesso.";

msg['VALIDATE_TOKEN']='Por favor insira o código de verificação';

msg['ADDRESS1_VALIDATE']="Por favor, insira o endereço";

msg['ADDRESS2_VALIDATE']="Por favor, insira o endereço";

msg['CITY_VALIDATE']="Por favor introduza cidade";

msg['CITY_VALIDATE_AlPHANUMERIC']="Por favor introduza cidade válida.";

msg['STATE_VALIDATE']="Por favor indicar Estado";

msg['ZIPCODE_VALIDATE_BLANK']="Por favor indicar Zipcode";
msg['ZIPCODE_VALIDATE_NUMERIC']="Digite seu 5 dígitos ou 5 dígitos CEP 4";
msg['ONLY_PHONE_VALIDATE']="Por favor, introduza o número do telefone";

//Hire Request - Employer
msg['EMPLOYER_HR_DELETE_SUCCESS']="Contratar pedido apagado com sucesso.";

//No data found in listing pages

msg['NO_AC_MAMAGER_FOUND']="Gerente de contas não encontrada.";
msg['NO_AC_MAMAGER_STATASTIC_FOUND']="Não contratar pedidos.";
msg['NO_OCCUPATION_STATASTIC_FOUND']="Não contratar pedidos.";

//tooltip
var tooltip=new Array(); 
tooltip['LOGIN_EMAIL']="Telefone ou e-mail";
tooltip['LOGIN_PASSWORD']="senha";
tooltip['EMPLOYER_EDIT_PROFILE_BUSINESS_NAME']="nome da empresa";
tooltip['EMPLOYER_EDIT_PROFILE_EMAIL']="E-mail";
tooltip['EMPLOYER_EDIT_PROFILE_FIRST_NAME']="primeiro nome";
tooltip['EMPLOYER_EDIT_PROFILE_LAST_NAME']="sobrenome";
tooltip['EMPLOYER_EDIT_PROFILE_TITLE']="título";
tooltip['EMPLOYER_CHANGE_PASSWORD_OLD']="senha antiga";
tooltip['EMPLOYER_CHANGE_PASSWORD_NEW']="nova senha";
tooltip['EMPLOYER_CHANGE_PASSWORD_CONFIRM']="confirmar senha";
tooltip['EMPLOYER_LOCATION_NAME']="nome";
tooltip['EMPLOYER_LOCATION_ADDRESS1']="Endereço";
tooltip['EMPLOYER_LOCATION_ADDRESS2']="Endereço2";
tooltip['EMPLOYER_LOCATION_CITY']="cidade";
tooltip['EMPLOYER_LOCATION_ZIPCODE']="zipcode";
tooltip['EMPLOYER_PHONE']="número de telefone";
tooltip['EMPLOYER_ADD_ACCOUNT_MANAGER_FNAME']="primeiro nome";
tooltip['EMPLOYER_ADD_ACCOUNT_MANAGER_LNAME']="sobrenome";
tooltip['EMPLOYER_ADD_ACCOUNT_MANAGER_TITLE']="título";
tooltip['EMPLOYER_ADD_ACCOUNT_MANAGER_PASSWORD']="senha";
tooltip['EMPLOYER_ADD_ACCOUNT_MANAGER_CPASSWORD']="confirmar senha";
tooltip['EMPLOYER_ADD_ACCOUNT_MANAGER_EMAIL']="E-mail";
tooltip['EMPLOYER_ADD_ACCOUNT_MANAGER_PHONE']="número de telefone";
tooltip['EMPLOYER_EDIT_PROFILE_LINK']="Editar perfil";
tooltip['EMPLOYER_CHANGE_PASSWORD_LINK']="alterar a senha";
tooltip['EMPLOYER_ADD_LOCATION_LINK']="adicionar a localização";
tooltip['EMPLOYER_ADD_PHONE_LINK']="Adicione telefone";
tooltip['EMPLOYER_READMORE']="leia mais";
tooltip['EMPLOYER_NEXT']="próximo";
tooltip['EMPLOYER_PREVIOUS']="anterior";
tooltip['EMPLOYER_HEADER_HELP']="ajuda";
tooltip['EMPLOYER_EDIT_PROFILE_TITLE']="título";


// Seeker
tooltip['SEEKER_EDIT_LINK']="editar";
tooltip['SEEKER_CHANGE_PASSWORD_LINK']="alterar a senha";
tooltip['SEEKER_LOCATION_NAME']="Nome";
tooltip['SEEKER_LOCATION_ADDRESS']="endereço";
tooltip['SEEKER_LOCATION_RADIUS']="raio";
tooltip['SEEKER_CHANGE_PASSWORD_LINK']="alterar a senha";

//Invalid  Linkedin,Twitter & Facebook validation message
msg['_VALIDATE_ID_'] = "Por favor, digite o URL válida para";
msg['_NO_EMAIL_'] = "Sem e-mail";

msg['_MAP_NULL_MESSAGE_'] = "<table class='infoicons'><tr><td class='defect'>Você não especificou as preferências de trabalho / localidade. Por favor, adicione locais para receber alertas de emprego!</td></tr></table>";
msg['_RESUME_SUCCESS_TO_SEEKER_'] = "Alertas retomada a partir _EMPLOYER_NAME_.";
msg['_STOP_RES_TO_SEEKER_'] = "Alertas de stoped _EMPLOYER_NAME_.";
msg['_HIRENOW_RES_STOP_SEEKER_ERROR_']="Sorry! Você já parar de pedido de _EMPLOYER_NAME_";

msg['_VALIDATE_CLOSE_POPUP_']="Por favor, confirme o Trabalho / Localização.";
msg['_VALIDATE_ACCEPTED_MISSING_']="aceitar acordo.";
msg['_AT_LEAST_ONE _ADDRESS_NEEDED_']="Pelo menos um local necessário.";
msg['_VERIFY_PHONE_POPUP_']='Para verificar o número de telefone de texto, "Verify _verifycode_" to (408)645-7916.';

//phone
msg['_RECEIVE_SMS_CHANGE_SUCCESS_']='Receber o status de SMS alterada com sucesso.';
msg['_NO_VERIFIED_PHONE_']='não verificado';
msg['_OCCUPATION_UPDATED_SSUCCESS_']='Ocupação atualizado com sucesso.';
msg['_BUSINESS_LOCATION_VALIDATE_']='Por favor, selecione o local de negócios.';
msg['_LANGUAGE_SELECT_VALIDATE_']='Por favor seleccione idiomas.';
msg['_JOBTYPE_SELECT_VALIDATE_']='Por favor seleccione TipoTrabalho.';
msg['_WORKSHIFT_SELECT_VALIDATE_']='Por favor seleccione turno de Trabalho.';
msg['_DUPLICATE_ENTRY_VALIDATE_']='duplicar a entrada não é permitida.';
msg['_OTHER_REASON_']='Por favor, indique a razão.';

//Mobile
msg['_NO_OCCUPATION_FOUND_']='Ocupação não encontrado.';

msg['_NO_LOCATION_FOUND_']='Nenhum local configurado.';

msg['_NO_PHONE_FOUND_']='Telefone não encontrado.';
msg['_NO_PENDING_HIRE_REQUEST_FOUND_']='Pedido contratar pendentes não encontrado.';
msg['_NO_FAVOURITE_SEEKERS_']='Não buscadores favoritos.';
msg['_NO_RECENT_ACTIVITY_']='Atividades recentes não encontrado.';
msg['_NO_OCCUPATION_STATASTIC_FOUND_']='Estatísticas de ocupação não encontrado.';
msg['_NO_LOCATION_CONFIGURE_']='Por favor, adicionar a localização de negócios para hirenow.';

msg['_RESTRIC_TO_CHANGE_EMAIL_']='Utilizar a conta de telefone para mudar de e-mail.';

//Message After tranlation
//application
msg['_REDIRECT_URI_SUCCESS_']='Redirecionamento URI atualizado com sucesso.';

//Contactus page  
msg['CONTACT_US_NAME_VALIDATE']="Introduza o seu nome.";
msg['CONTACT_US_EMAIL_VALIDATE']="Por favor, Digite e-mail.";
msg['CONTACT_US_VEMAIL_VALIDATE']="Por favor, Digite e-mail válidos.";
msg['CONTACT_US_COMMENT_VALIDATE']="Por favor Entre Comentário.";
msg['CONTACT_US_VCOMMENT_VALIDATE']="Comentário conter pelo menos 20 caracteres.";
msg['CONTACT_US_CAPTCHA_VALIDATE']="Por favor indicar captcha válido.";

//Hire now
msg['HIRENOW_SUCCESS']="Pedido enviado com sucesso contratar.";

//Active
msg['ACTIVE_EMAIL_VALIDATE']="Por favor, indique-mail";
msg['ACTIVE_VEMAIL_VALIDATE']="Por favor indicar email válido";


//Request_accept
msg['REQUEST_REPLY_SUCCESS']="Pedido Replied com sucesso";
msg['OCCUPATION_UPDATE']="Ocupações atualizado com sucesso";

//Regular Expressions for validations
msg['FULL_NAME_REG']=/^[A-Za-z ]*$/;
msg['FIRST_NAME_REG']=/^[A-Za-z]*$/;
msg['FIRST_NAME_REG_SPECIAL_CHARACTER']="Sem caracteres especiais";

msg['LAST_NAME_REG']=/^[A-Za-z]*$/;
msg['LAST_NAME_REG_SPECIAL_CHARACTER']="Sem caracteres especiais";

msg['EMAIL_REG']=/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

msg['PHONE_REG']=/^\(?[2-9]\d{2}[\)\.-]?\s?\d{3}[\s\.-]?\d{4}$/;

msg['IS_URL_REG']=/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;

msg['IS_VALID_US_ZIP_REG'] =/^\d{5}(-\d{4})?$/;

msg['BUSINESS_PROFILE_REG'] =/^[a-zA-Z0-9_]*$/;
msg['BUSINESS_PROFILE_VALIDATE'] = "Sem caracteres especiais";
msg['BUSINESS_PROFILE_CHARACTERS'] = "Mínimo de 5 caracteres reqiured";

msg['BUSINESS_NAME_REG']=/^[A-Za-z0-9-#&,\. ']*$/;
msg['BUSINESS_NAME_REGEX']=/^[A-Za-z0-9-#&,\. ']*$/;
msg['BUSINESS_NAME_REG_SPECIAL_CHARACTER']="Sem caracteres especiais";
msg['COMMENT_REG']=/^[A-Za-z0-9-!?,\.\n\r '\"]*$/;

msg['CITY_REG_SPECIAL_CHARACTER']="Digite cidade válida";

msg['NUMBERS_REG']=/[0-9]/;
msg['UPPERCASE_LETTER_REG']=/[A-Z]/;
msg['LOWERCASE_LETTER_REG']=/[a-z]/;
msg['SPECIAL_CHARACTERS_REG']=/.[!,@,#,$,%,^,&,*,?,_,~,-,£,(,)]/;

msg['WEAK_PASSWORD']="senha fraca";
msg['MEDIUM_PASSWORD']="boa senha";
msg['STRONG_PASSWORD']="senhas fortes";

msg['ADDRESS_REG']=/^[A-Za-z0-9-#:()&,\.\n\r ']*$/;
msg['DESCRIPTION_REG']=/^[A-Za-z0-9-!#&,?;\.\n\r ']*$/;
msg['WEBSITE_REG']=/^(http(s?):\/\/)?[a-zA-Z0-9\.\-\_]+(\.[a-zA-Z]{2,3})+(\/[a-zA-Z0-9\_\-\s\.\/\?\%\#\&\=]*)?$/;
msg['NOT_VALID_URL']="Não URL válida";
msg['TITLE_REG']=/^[A-Za-z-#&,\. ']*$/;
msg['CITY_REG']=/^[A-Za-z ']*$/;
msg['CITY_REG_SPECIAL_CHARACTER']="Digite cidade válida";	/////////Validations Ends here////////////

msg['_SEEKER_REG_PHONE_']="número de telefone";
msg['_SEEKER_REG_EMAIL_']="E-mail";
msg['_SEEKER_REG_FIRST_NAME_']="Nome";
msg['_SEEKER_REG_LAST_NAME_']="sobrenome";
msg['_BTN_OK_']="Ok";
msg['_EMPLOYER_PHONE_']="número de telefone";
msg['_EMPLOYER_EMAIL_']="Email";
msg['_EMPLOYER_FIRST_NAME_']="Nome";
msg['_EMPLOYER_LAST_NAME_']="sobrenome";

msg['_BUSINESS_LOGO_UPLOADING_']="Logo negócios está carregando";
msg['_AVATAR_UPLOADING_']="Imagem está carregando";
msg['_UPLOADING_']='Uploading';
msg['_EMPLOYER_ADVANCED_ABOUT_LOGO_JAVASCRIPT_']='Logo está salvando';
msg['BUSINESS_PROFILE_CHARACTERS_LEN'] = "Máximo de 25 caracteres permitidos.";
msg['LABEL_VALIDATE_ERROR_MAXLEN']="Max name length is 25 characters.";
msg['TITLE_LENGTH']="Máximo de 25 caracteres permitidos";
msg["YES"]="Sim";
msg["NO"]="Nao";
msg["NO_MATCHING_JOBS"]="Não há empregos correspondentes ao seu perfil nas áreas de seu interesse.";
msg["ONE_MATCHING_JOBS"]="Há um trabalho correspondentes ao seu perfil nas áreas de seu interesse.";
msg["MATCHING_JOBS_PART1"]="há ";
msg["MATCHING_JOBS_PART2"]=" empregos correspondentes ao seu perfil nas áreas de seu interesse.";
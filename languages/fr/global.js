// JavaScript Document
var msg=new Array(); 
//msg[0]="<img src='"+BASHPATH+"public/images/spinner-small.gif' alt='Chargement'>";   

// Validation for Sign Up Form -- Seeker

msg['FNAME_VALIDATE']="Veuillez saisir le prénom";
msg['LNAME_VALIDATE']="Veuillez saisir le nom de famille";
msg['EMAIL_VALIDATE']="Veuillez spécifier email, téléphone ou les deux";
msg['VEMAIL_VALIDATE']="Veuillez spécifier email, téléphone ou les deux";
msg['SUCCESS_EMAIL_VALIDATE']="Nous enverrons un email de vérification à cette adresse email";
msg['ERROR_EMAIL_VALIDATE']="Cette adresse email n'est pas disponible pour enregistrement. Veuillez spécifier email, téléphone ou les deux";
msg['PHONE_VALIDATE']="Veuillez spécifier l'email ou le téléphone";
msg['VPHONE_VALIDATE']="n'est pas un numéro de téléphone US valide";
msg['APHONE_VALIDATE']="Le numéro de téléphone est disponible pour enregistrement";
msg['NAPHONE_VALIDATE']="Le numéro de téléphone n'est pas disponible pour enregistrement";
msg['PASSWORD_VALIDATE']="Veuillez saisir un mot de passe valide";
msg['VPASSWORD_VALIDATE']="Mot de passe doit être plus grand que 6 caractères";
msg['CPASSWORD_VALIDATE']="Veuillez saisir de nouveau le mot de passe";
msg['MPASSWORD_VALIDATE']="Mot de passe et sa confirmation ne concordent pas";
msg['_OLD_NEW_VALIDATE_']="Vieil et nouveau mot de passe ne doivent pas être le même";
msg['LOCATION_VALIDATE']="Veuillez saisir l'adresse";
msg['_LOCATION_ON_SUBMIT_VALIDATE_']="Cette adresse doit être complète.";
msg['PLOCATION_VALIDATE']="Veuillez saisir l'endroit";
msg['VLOCATION_VALIDATE']="Saisissez au minimum 4 caractères";
msg['DISTANCE_VALIDATE']="Veuillez saisir la distance en milles";
msg['VDISTANCE_VALIDATE']="La distance doit être numérique";
msg['OCCUPATION_VALIDATE']="Choisir au moins une profession";
msg['CONTACT_VALIDATE']="Choisir au moins un type de communication";
msg['JOBTYPE_VALIDATE']="Choisir au moins un type d'emploi";
msg['WORK_SCHEDULE_VALIDATE']="Choisir au moins un type d'horaire";
msg['PHONE_NUMBER']="Phone Number";
msg['WORK_SHIFT_VALIDATE']="Choisir au moins un type de quart de travail";
msg['LANGUAGE_VALIDATE']="Choisir au moins une langue";
msg['RADIUS_VALIDATE']="Veuillez saisir le rayon en milles";
msg['VRADIUS_VALIDATE']="Rayon doit être numérique";
msg['VRADIUS_VALIDATE_LIMIT']="Le rayon doit être positif ou moindre que 50.";

//Add Account Manager

msg['PASSWORD_LENGTH_VALIDATE_ACCOUNTMANAGER']="Minimum 6 caractères";
msg['PASSWORD_METCH_VALIDATE_ACCOUNTMANAGER']="Mots de passe ne concordent pas";
msg['PHONE_VALIDATE_ACCOUNTMANAGER']="Saisissez le numéro de téléphone";
msg['PHONE_VALIDATE_NOT_VALID_ACCOUNTMANAGER']="Pas un numéro US valide";

msg['PHONE_VALIDATE_SUCCESS_ACCOUNTMANAGER']="Disponible pour enregistrement";
msg['EMAIL_VALIDATE_ACCOUNT_MANAGER']="Spécifier email, téléphone ou les deux";
msg['EMAIL_VALIDATE_VALID_ERROR_ACCOUNT_MANAGER']="Non valide.";
msg['SUCCESS_EMAIL_VALIDATE_ACCOUNT_MANAGER']="Disponible pour enregistrement.";
msg['FNAME_VALIDATE_ACCOUNTMANAGER']="Saisissez prénom";
msg['LNAME_VALIDATE_ACCOUNTMANAGER']="Saisissez nom de famille";
msg['PASSWORD_VALIDATE_ACCOUNTMANAGER']="Saisissez mot de passe";
msg['CPASSWORD_VALIDATE_ACCOUNTMANAGER']="Saisissez de nouveau mot de passe";
msg['EMAIL_NOT_AVAILABLE_VALIDATE_ERROR']="Non disponible pour enregistrement";
msg['PHONE_NOT_AVAILABLE_VALIDATE_ERROR']="Non disponible pour enregistrement";
msg['ACCOUNT_MANAGER_CREATED_SUCCESS']="Gestionnaire de compte créé avec succès.";

// End Validation for Seeker

//ADD location

msg['LABEL_VALIDATE_ERROR']="Saisissez le nom pour cette adresse";
msg['ADDRESS_NEED TO_COMPLETE_ERROR']="Cette adresse doit être complète.";

// Validation for Sign Up Form -- Employertest

msg['BNAME_VALIDATE']="Saisissez nom de l'entreprise";
msg['BADDRESS_VALIDATE']="Veuillez saisir l'adresse de l'entreprise";
msg['BTYPE_VALIDATE']="Choisir au moins un type de profession";
msg['GOOGLE_ADDRESS_VALIDATE']="L'adresse que vous avez entré, ne semble pas être exacte. Voulez-vous utiliser l'adresse suivante à la place?<br /> ";
msg['GOOGLE_BUSINESS_ADDRESS_VALIDATE']="L'adresse que vous avez entrée correspond à l'adresse suivante. Allons-nous utiliser les coordonnées GPS de l'adresse suivante? <br /> ";
msg['GOOGLE_ADDRESS_ADD_VALIDATE']="Désolé, nous n'avons pu trouvé l'adresse spécifiée. Veuillez saisir de nouveau.";
msg['GOOGLE_BUSINESS_ADDRESS_ADD_VALIDATE']="Veuillez spécifier l'adresse complète pour cette entreprise. Veuillez saisir de nouveau.";
msg['_GOOGLE_ADDRESS_SAME_VALIDATE_']="Veuillez ne pas utiliser la même adresse.";
msg['NO_MATCHING_CANDIDATE']="Toujours pas de candidats concordants.";
msg['_GOOGLE_ADDRESS_VALIDATE_EMPLOYER_']="Votre adresse ne concorde pas avec l'adresse de l'api google.";
// End Validation for Employer


// Validation for Activate.tpl   --User

msg['CAPTCHA_VALIDATE_ACTIVATE']="Veuillez saisir un captcha valide";

// End Validation for Employer

//Employer user account 
msg['ADS']="Compte supprimé avec succès";
msg['ADE']="Erreur de suppression de compte";


//Employer Location 
msg['LAS']="Endroit ajouté avec succès";

msg['LAE']="Erreur dans l'ajout de l'endroit";

msg['LUS']="Endroit mis à jour avec succès";

msg['LUE']="Erreur dans la mise à jour de l'endroit";

msg['PAS']="Téléphone ajouté avec succès";

msg['PAE']="Erreur dans l'ajout du téléphone";

msg['PDS']="Téléphone supprimé avec succès";
msg['PDE']="Erreur dans la suppression du téléphone";

msg['LDS']="Endroit supprimé avec succès";
msg['LDE']="Erreur dans la suppression de l'endroit";

msg['LES']="Endroit modifié avec succès";
msg['LEE']="Erreur dans la modification de l'endroit";

msg['DLCS']="Endroit par défaut modifié avec succès";
msg['PLCS']="Endroit primaire modifié avec succès.";

//Modifier profil

msg['OCCUPATION_VALIDATE_ERROR']="Au moins une profession";
msg['CONTACT_VALIDATE_ERROR']="At least one communication preference";
msg['PROFILE_UPDATE']="Profile mis à jour avec succès";

// Forgot Mot de passe
msg['FP_SUCCESS']="Mot de passe modifié avec succès";
msg['EMAIL_PHONE']="Please enter email or phone";
msg['VEMAIL_PHONE']="Enter valid email or phone";

//Hire Request - Seeker
msg['HR_DELETE_SUCCESS']="Location de la demande supprimé avec succès.";

msg['VALIDATE_TOKEN']='Veuillez saisir le code de vérification';

msg['ADDRESS1_VALIDATE']="Veuillez saisir l'adresse";

msg['ADDRESS2_VALIDATE']="Veuillez saisir l'adresse";

msg['CITY_VALIDATE']="Veuillez saisir la ville";

msg['CITY_VALIDATE_AlPHANUMERIC']="Veuillez saisir une ville valide.";

msg['STATE_VALIDATE']="Veuillez saisir l'état";

msg['ZIPCODE_VALIDATE_BLANK']="Veuillez saisir le code postal";
msg['ZIPCODE_VALIDATE_NUMERIC']="Veuillez saisir votre code postal au complet";
msg['ONLY_PHONE_VALIDATE']="Veuillez saisir le numéro de téléphone";

//Hire Request - Employer
msg['EMPLOYER_HR_DELETE_SUCCESS']="Location de la demande supprimé avec succès.";

//No data found in listing pages

msg['NO_AC_MAMAGER_FOUND']="Aucun gestionnaire de compte trouvé.";
msg['NO_AC_MAMAGER_STATASTIC_FOUND']="Aucune demande de location.";
msg['NO_OCCUPATION_STATASTIC_FOUND']="Aucune demande de location.";

//tooltip
var tooltip=new Array(); 
tooltip['LOGIN_EMAIL']="Téléphone ou email";
tooltip['LOGIN_PASSWORD']="Mot de passe";
tooltip['EMPLOYER_EDIT_PROFILE_BUSINESS_NAME']="Nom de l'entreprise";
tooltip['EMPLOYER_EDIT_PROFILE_EMAIL']="Email";
tooltip['EMPLOYER_EDIT_PROFILE_FIRST_NAME']="Prénom";
tooltip['EMPLOYER_EDIT_PROFILE_LAST_NAME']="Nom de famille";
tooltip['EMPLOYER_EDIT_PROFILE_TITLE']="Titre";
tooltip['EMPLOYER_CHANGE_PASSWORD_OLD']="Vieux mot de passe";
tooltip['EMPLOYER_CHANGE_PASSWORD_NEW']="Nouveau mot de passe";
tooltip['EMPLOYER_CHANGE_PASSWORD_CONFIRM']="Confirmer le mot de passe";
tooltip['EMPLOYER_LOCATION_NAME']="Nom";
tooltip['EMPLOYER_LOCATION_ADDRESS1']="Adresse";
tooltip['EMPLOYER_LOCATION_ADDRESS2']="Adresse2";
tooltip['EMPLOYER_LOCATION_CITY']="Ville";
tooltip['EMPLOYER_LOCATION_ZIPCODE']="Code postal";
tooltip['EMPLOYER_PHONE']="Numéro de téléphone";
tooltip['EMPLOYER_ADD_ACCOUNT_MANAGER_FNAME']="Prénom";
tooltip['EMPLOYER_ADD_ACCOUNT_MANAGER_LNAME']="Nom de famille";
tooltip['EMPLOYER_ADD_ACCOUNT_MANAGER_TITLE']="Titre";
tooltip['EMPLOYER_ADD_ACCOUNT_MANAGER_PASSWORD']="Mot de passe";
tooltip['EMPLOYER_ADD_ACCOUNT_MANAGER_CPASSWORD']="Confirmer le mot de passe";
tooltip['EMPLOYER_ADD_ACCOUNT_MANAGER_EMAIL']="Email";
tooltip['EMPLOYER_ADD_ACCOUNT_MANAGER_PHONE']="Numéro de téléphone";
tooltip['EMPLOYER_EDIT_PROFILE_LINK']="Modifier profil";
tooltip['EMPLOYER_CHANGE_PASSWORD_LINK']="Modifier mot de passe";
tooltip['EMPLOYER_ADD_LOCATION_LINK']="Ajouter endroit";
tooltip['EMPLOYER_ADD_PHONE_LINK']="Ajouter téléphone";
tooltip['EMPLOYER_READMORE']="Lire davantage";
tooltip['EMPLOYER_NEXT']="Suivant";
tooltip['EMPLOYER_PREVIOUS']="Précédent";
tooltip['EMPLOYER_HEADER_HELP']="Aide";
tooltip['EMPLOYER_EDIT_PROFILE_TITLE']="Titre";


// Seeker
tooltip['SEEKER_EDIT_LINK']="Modifier";
tooltip['SEEKER_CHANGE_PASSWORD_LINK']="Modifier mot de passe";
tooltip['SEEKER_LOCATION_NAME']="Nom";
tooltip['SEEKER_LOCATION_ADDRESS']="Adresse";
tooltip['SEEKER_LOCATION_RADIUS']="Rayon";
tooltip['SEEKER_CHANGE_PASSWORD_LINK']="Modifier mot de passe";

//Invalid  Linkedin,Twitter & Facebook validation message
msg['_VALIDATE_ID_'] = "S'il vous plaît entrez l'URL valide pour";
msg['_NO_EMAIL_'] = "Aucun email";

msg['_MAP_NULL_MESSAGE_'] = "<table class='infoicons'><tr><td class='defect'>Vous n'avez spécifié aucune préférences d'emploi/endroit. Veuillez ajouter des endroits pour recevoir des alertes d'emploi!</td></tr></table>";
msg['_RESUME_SUCCESS_TO_SEEKER_'] = "Alertes résumées de _EMPLOYER_NAME_.";
msg['_STOP_RES_TO_SEEKER_'] = "Stoped alerts from _EMPLOYER_NAME_.";
msg['_HIRENOW_RES_STOP_SEEKER_ERROR_']="Désolé! Vous avez déjà arrêté la requête de _EMPLOYER_NAME_";

msg['_VALIDATE_CLOSE_POPUP_']="Veuillez confimer le travail/endroit.";
msg['_VALIDATE_ACCEPTED_MISSING_']="Accepter l'accord.";
msg['_AT_LEAST_ONE _ADDRESS_NEEDED_']="Au moins un endroit nécessaire.";
msg['_VERIFY_PHONE_POPUP_']='Pour vérifier le numéro de téléphone, envoyer "Verify _verifycode_" à (408)645-7916.';

//phone
msg['_RECEIVE_SMS_CHANGE_SUCCESS_']='État du SMS reçu modifié avec succès.';
msg['_NO_VERIFIED_PHONE_']='Non vérifié';
msg['_OCCUPATION_UPDATED_SSUCCESS_']='Profession mise à jour avec succès.';
msg['_BUSINESS_LOCATION_VALIDATE_']='Veuillez choisoir l\'endroit de l\'entreprise.';
msg['_LANGUAGE_SELECT_VALIDATE_']='Veuillez choisir les langues.';
msg['_JOBTYPE_SELECT_VALIDATE_']='Veuillez choisir le type d\'emploi.';
msg['_WORKSHIFT_SELECT_VALIDATE_']='Veuillez choisir le quart de travail.';
msg['_DUPLICATE_ENTRY_VALIDATE_']='entrée en double non permis.';
msg['_OTHER_REASON_']='Veuillez spécifier la raison.';

//Mobile
msg['_NO_OCCUPATION_FOUND_']='Profession non trouvée.';

msg['_NO_LOCATION_FOUND_']='Aucun endroit configuré.';

msg['_NO_PHONE_FOUND_']='Téléphone non trouvé.';
msg['_NO_PENDING_HIRE_REQUEST_FOUND_']='Demande d\'embauche en attente non trouvée.';
msg['_NO_FAVOURITE_SEEKERS_']='Aucun des demandeurs préférés.';
msg['_NO_RECENT_ACTIVITY_']='Activités récentes non trouvées.';
msg['_NO_OCCUPATION_STATASTIC_FOUND_']='Statistiques de la profession non trouvées.';
msg['_NO_LOCATION_CONFIGURE_']='Veuillez ajouter l\'endroit de l\'entreprise pour hirenow.';

msg['_RESTRIC_TO_CHANGE_EMAIL_']='Utiliser un autre compte de téléphone pour modifiel l\'email.';

//Message After tranlation
//application
msg['_REDIRECT_URI_SUCCESS_']='Rediriger URI correctement mis à jour.';

//Contactus page  
msg['CONTACT_US_NAME_VALIDATE']="S'il vous plaît Entrez votre nom.";
msg['CONTACT_US_EMAIL_VALIDATE']="S'il vous plaît Entrez Email.";
msg['CONTACT_US_VEMAIL_VALIDATE']="S'il vous plaît entrer une adresse valide.";
msg['CONTACT_US_COMMENT_VALIDATE']="S'il vous plaît Ecrire un commentaire.";
msg['CONTACT_US_VCOMMENT_VALIDATE']="Commentaire contenir au moins 20 caractères.";
msg['CONTACT_US_CAPTCHA_VALIDATE']="S'il vous plaît entrer captcha valide.";

//Hire now
msg['HIRENOW_SUCCESS']="Demande de location envoyé avec succès.";

//Active
msg['ACTIVE_EMAIL_VALIDATE']="S'il vous plaît entrer une adresse";
msg['ACTIVE_VEMAIL_VALIDATE']="S'il vous plaît entrer une adresse valide";

//Request_accept
msg['REQUEST_REPLY_SUCCESS']="Demande Replied succès";
msg['OCCUPATION_UPDATE']="Professions à jour avec succès";

//Regular Expressions for validations
msg['FULL_NAME_REG']=/^[A-Za-z ]*$/;
msg['FIRST_NAME_REG']=/^[A-Za-z]*$/;
msg['FIRST_NAME_REG_SPECIAL_CHARACTER']="Pas de caractères spéciaux";

msg['LAST_NAME_REG']=/^[A-Za-z]*$/;
msg['LAST_NAME_REG_SPECIAL_CHARACTER']="Pas de caractères spéciaux";

msg['EMAIL_REG']=/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

msg['PHONE_REG']=/^\(?[2-9]\d{2}[\)\.-]?\s?\d{3}[\s\.-]?\d{4}$/;

msg['IS_URL_REG']=/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;

msg['IS_VALID_US_ZIP_REG'] =/^\d{5}(-\d{4})?$/;

msg['BUSINESS_PROFILE_REG'] =/^[a-zA-Z0-9_]*$/;
msg['BUSINESS_PROFILE_VALIDATE'] = "Pas de caractères spéciaux";
msg['BUSINESS_PROFILE_CHARACTERS'] = "5 caractères minimum obligatoire si";

msg['BUSINESS_NAME_REG']=/^[A-Za-z0-9-#&,\. ']*$/;
msg['BUSINESS_NAME_REGEX']=/^[A-Za-z0-9-#&,\. ']*$/;
msg['BUSINESS_NAME_REG_SPECIAL_CHARACTER']="Pas de caractères spéciaux";
msg['COMMENT_REG']=/^[A-Za-z0-9-!?,\.\n\r '\"]*$/;

msg['CITY_REG_SPECIAL_CHARACTER']="Entrez une ville valide";

msg['NUMBERS_REG']=/[0-9]/;
msg['UPPERCASE_LETTER_REG']=/[A-Z]/;
msg['LOWERCASE_LETTER_REG']=/[a-z]/;
msg['SPECIAL_CHARACTERS_REG']=/.[!,@,#,$,%,^,&,*,?,_,~,-,£,(,)]/;

msg['WEAK_PASSWORD']="mot de passe faible";
msg['MEDIUM_PASSWORD']="bon mot de passe";
msg['STRONG_PASSWORD']="mot de passe fort";

msg['ADDRESS_REG']=/^[A-Za-z0-9-#:()&,\.\n\r ']*$/;
msg['DESCRIPTION_REG']=/^[A-Za-z0-9-!#&,?;\.\n\r ']*$/;
msg['WEBSITE_REG']=/^(http(s?):\/\/)?[a-zA-Z0-9\.\-\_]+(\.[a-zA-Z]{2,3})+(\/[a-zA-Z0-9\_\-\s\.\/\?\%\#\&\=]*)?$/;
msg['NOT_VALID_URL']="Non URL valide";
msg['TITLE_REG']=/^[A-Za-z-#&,\. ']*$/;
msg['CITY_REG']=/^[A-Za-z ']*$/;
msg['CITY_REG_SPECIAL_CHARACTER']="Entrez une ville valide";	/////////Validations Ends here////////////

msg['_SEEKER_REG_PHONE_']="Numéro de téléphone";
msg['_SEEKER_REG_EMAIL_']="Email";
msg['_SEEKER_REG_FIRST_NAME_']="Prénom";
msg['_SEEKER_REG_LAST_NAME_']="Nom";
msg['_BTN_OK_']="Ok";
msg['_EMPLOYER_PHONE_']="Numéro de téléphone";
msg['_EMPLOYER_EMAIL_']="Email";
msg['_EMPLOYER_FIRST_NAME_']="Prénom";
msg['_EMPLOYER_LAST_NAME_']="Nom";

msg['_BUSINESS_LOGO_UPLOADING_']="Logo d'entreprise est de chargement";
msg['_AVATAR_UPLOADING_']="L'image est de chargement";
msg['_UPLOADING_']='Téléchargement';
msg['_EMPLOYER_ADVANCED_ABOUT_LOGO_JAVASCRIPT_']='Logo est de sauver';
msg['BUSINESS_PROFILE_CHARACTERS_LEN'] = "Maximum de 25 caractères autorisés.";
msg['LABEL_VALIDATE_ERROR_MAXLEN']="Max name length is 25 characters.";
msg['TITLE_LENGTH']="Maximum de 25 caractères autorisés";
msg["YES"]="Oui";
msg["NO"]="Non";
msg["NO_MATCHING_JOBS"]="Il n'y a pas d'emplois correspondant à votre profil dans les domaines de votre intérêt.";
msg["ONE_MATCHING_JOBS"]="Il ya 1 poste correspondant à votre profil dans les domaines de votre intérêt.";
msg["MATCHING_JOBS_PART1"]="Il ya ";
msg["MATCHING_JOBS_PART2"]=" emplois correspondant à votre profil dans les domaines de votre intérêt.";
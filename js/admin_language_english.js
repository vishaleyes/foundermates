var adminmsg=new Array(); 
adminmsg[0]="<img src='"+BASHPATH+"public/images/spinner-small.gif' alt='Loading'>"; 
// Validation for Sign Up Form -- Seeker 
adminmsg['_FNAME_VALIDATE_']="Please enter first name";
adminmsg['_LNAME_VALIDATE_']="Please enter last name";
adminmsg['_EMAIL_VALIDATE_']="Please specify email, phone or both";
adminmsg['_SUCCESS_EMAIL_VALIDATE_']="We will send a verification email to this email";
adminmsg['_ADMIN_ERROR_EMAIL_VALIDATE_']="This email is not available to register.";
adminmsg['_VEMAIL_VALIDATE_']="Please specify email, phone or both";
adminmsg['_PHONE_VALIDATE_']="Please specify email or phone";
adminmsg['_VPHONE_VALIDATE_']="is not a valid US phone number";
adminmsg['_APHONE_VALIDATE_']="Phone number is available to register";

adminmsg['_NAPHONE_VALIDATE_']="Phone number not available to register";
adminmsg['_LANGUAGE_VALIDATE_']="Select at least one language";
adminmsg['_RADIUS_VALIDATE_']="Please enter radius in miles";
adminmsg['_VRADIUS_VALIDATE_']="Radius must be numeric";

//Account Managers
adminmsg['_PASSWORD_VALIDATE_']="Please enter valid password";
adminmsg['_VPASSWORD_VALIDATE_']="Password must be greater than 6 characters";
adminmsg['_CPASSWORD_VALIDATE_']="Please re-enter password";
adminmsg['_MPASSWORD_VALIDATE_']="Password and confirm password not match";
adminmsg['_JOBTYPE_VALIDATE_']="Select at least one job type";
adminmsg['_WORK_SCHEDULE_VALIDATE_']="Select at least one schedule type";
adminmsg['_ATLEAST_NUMBER_']="Password must contain at least one number";
adminmsg['_ATLEAST_UPPERCASE_LETTER_']="Password must contain at least one uppercase letters";
adminmsg['_ATLEAST_LOWERCASE_LETTER_']="Password must contain at least one lowercase letters";
adminmsg['_ATLEAST_SPECIAL_CHARACTER_']="Password must contain at least one special character";
//End of Validation Seeker ane Account Manager

// Validation for Sign Up Form -- Employer
adminmsg['_ZIPCODE_VALIDATE_BLANK_']="Please enter Zipcode";
adminmsg['_ZIPCODE_VALIDATE_NUMERIC_']="Please enter your 5 digit or 5 digit+4 zip code";
adminmsg['_BNAME_VALIDATE_']="Please enter business name";
adminmsg['_BADDRESS_VALIDATE_']="Please enter business address";
adminmsg['_VLOCATION_VALIDATE_']="Enter minimum 4 characters";
adminmsg['_GOOGLE_ADDRESS_VALIDATE_']="The address you have entered, does not appear to be accurate.Would you like to use the following address instead?<br /> ";
adminmsg['_GOOGLE_ADDRESS_ADD_VALIDATE_']="The address you have entered, does not appear to be accurate. Do you still want to add?";
adminmsg['_PLOCATION_VALIDATE_']="Please enter location";
adminmsg['_DISTANCE_VALIDATE_']="Please enter distance in miles";
adminmsg['_VDISTANCE_VALIDATE_']="Distance must be numeric";
adminmsg['_OCCUPATION_VALIDATE_']="Select at least one occupation";
adminmsg['_CONTACT_VALIDATE_']="Select at least one communication type";
adminmsg['_ADDRESS1_VALIDATE_']="Please enter address";
adminmsg['_ADDRESS2_VALIDATE_']="Please enter address";
adminmsg['_CITY_VALIDATE_']="Please enter city";
adminmsg['_STATE_VALIDATE_']="Please enter State";
adminmsg['_LOCATION_VALIDATE_']="Please enter address";
adminmsg['_BPHONE_VALIDATE_']="Please enter phone number";

//Regular expression for validations
adminmsg['NUMBERS_REG']=/[0-9]/;
adminmsg['UPPERCASE_LETTER_REG']=/[A-Z]/;
adminmsg['LOWERCASE_LETTER_REG']=/[a-z]/;
adminmsg['SPECIAL_CHARACTERS_REG']=/[.,!,@,#,$,%,^,&,*,?,_,~,-,£,(,)]/;
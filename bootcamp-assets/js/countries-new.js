// country,code (w/ no '+' prefix)
// Countries
var country_arr = new Array("India~+91","United States~+1","Singapore~+65","Afghanistan~+93","Albania~+355","Algeria~+213","American Samoa~+1-684","Angola~+244","Anguilla~+1-264","Antartica~+672","Antigua and Barbuda~+1-268","Argentina~+54","Armenia~+374","Aruba~+297","Ashmore and Cartier Island~	","Australia~+61","Austria	~+43","Azerbaijan~+994","Bahamas~+1-242","Bahrain~+973","Bangladesh~+880","Barbados~+1-246","Belarus~+375","Belgium~+32","Belize~+501","Benin~+229","Bermuda~+1-441","Bhutan~+975","Bolivia~+591","Bosnia and Herzegovina~+387","Botswana~+267","Brazil~+55","British Virgin Islands~+1-284","Brunei~+673","Bulgaria~+359","Burkina Faso~+226","Burma~+95","Burundi~+257","Cambodia~+855","Cameroon~+237","Canada~+1","Cape Verde~+238","Cayman Islands~+1-345","Central African Republic~+236","Chad~+235","Chile~+56","China~+86","Christmas Island~+53","Clipperton Island~	","Cocos (Keeling) Islands~+61","Colombia~+57","Comoros~+269","Congo, Democratic Republic of the~+243","Congo, Republic of the~+242","Cook Islands~+682","Costa Rica~+506","Cote d'Ivoire~+225","Croatia~+385","Cuba~+53","Cyprus~+357","Czeck Republic~+420","Denmark~+45","Djibouti~+253","Dominica~+1-767","Dominican Republic~+1-809 ","Ecuador~+593 ","Egypt~+20","El Salvador~+503","Equatorial Guinea~+240","Eritrea~+291","Estonia~+372","Ethiopia~+251","Europa Island~	","Falkland Islands (Islas Malvinas)~+500","Faroe Islands~+298","Fiji~+679","Finland~+358","France~+33","French Guiana~+594","French Polynesia~+689","French Southern and Antarctic Lands~	","Gabon~+241","Gambia, The~+220","Gaza Strip~+970","Georgia~+995","Germany~+49","Ghana~+233","Gibraltar~+350","Glorioso Islands~	","Greece~+30","Greenland~+299","Grenada~+1-473","Guadeloupe~+590","Guam~+1-671","Guatemala~+502","Guernsey~+44","Guinea~+224","Guinea-Bissau~+245","Guyana~+592","Haiti~+509","Heard Island and McDonald Islands~	","Holy See (Vatican City)~	","Honduras~+504","Hong Kong~+852","Howland Island~	","Hungary~+36","Iceland~+354","Indonesia~+62","Iran~+98","Iraq~+964","Ireland~+353","Israel~+972","Italy~+39","Jamaica~+1-876","Jan Mayen~+47","Japan~+81","Jarvis Island~","Jersey~","Johnston Atoll~","Jordan~+962","Juan de Nova Island~	","Kazakhstan~+7","Kenya~+254","Kiribati~+686","Korea, North~+850","Korea, South~+82","Kuwait~+965","Kyrgyzstan~+996","Laos~+856","Latvia~+371","Lebanon~+961","Lesotho~+266","Liberia~+231","Libya~+218","Liechtenstein~+423","Lithuania~+370","Luxembourg~+352","Macau~+853","Macedonia, Former Yugoslav Republic of~+389","Madagascar~+261","Malawi~+265","Malaysia~+60","Maldives~+960","Mali~+223","Malta~+356","Man, Isle of~	","Marshall Islands~+692","Martinique~+596","Mauritania~+222","Mauritius~+230","Mayotte~+269","Mexico~+52","Micronesia, Federated States of~+691","Midway Islands~	","Moldova~+373","Monaco~+377","Mongolia~+976","Montserrat~+1-664","Morocco~+212","Mozambique~+258","Namibia~+264","Nauru~+674","Nepal~+977","Netherlands~+31","Netherlands Antilles~+599","New Caledonia~+687","New Zealand~+64","Nicaragua~+505","Niger~+227","Nigeria~+234","Niue~+683","Norfolk Island~+672","Northern Mariana Islands~+1-670","Norway~+47","Oman~+968","Pakistan~+92","Palau~+680","Panama~+507","Papua New Guinea~+675","Paraguay~+595","Peru~+51","Philippines~+63","Pitcaim Islands~","Poland~+48","Portugal~+351","Puerto Rico~+1-787","Qatar~+974 ","Reunion~+262","Romainia~+40","Russia~+7","Rwanda~+250","Saint Helena~+290","Saint Kitts and Nevis~+1-869","Saint Lucia~+1-758","Saint Pierre and Miquelon~+508","Saint Vincent and the Grenadines~+1-784","Samoa~+685","San Marino~+378","Sao Tome and Principe~+239","Saudi Arabia~+966","Scotland~	","Senegal~+221","Seychelles~+248","Sierra Leone~+232","Slovakia~+421","Slovenia~+386","Solomon Islands~+677","Somalia~+252","South Africa~+27","South Georgia and South Sandwich Islands~	","Spain~+34","Spratly Islands	~	","Sri Lanka~+94","Sudan~+249","Suriname~+597","Svalbard~	","Swaziland~+268","Sweden~+46","Switzerland~+41","Syria~+963","Taiwan~+886","Tajikistan~+992","Tanzania~+255","Thailand~+66","Tobago~	","Toga~	","Tokelau~+690","Tonga~+676","Trinidad~+1-868","Tunisia~+216","Turkey~+90","Turkmenistan~+993","Tuvalu~+688","Uganda~+256","Ukraine~+380","United Arab Emirates~+971","United Kingdom~+44","Uruguay~+598","Uzbekistan~+998","Vanuatu~	","Venezuela~+58","Vietnam~+84","Virgin Islands~+1","Wales~	","Wallis and Futuna~+681","West Bank~	","Western Sahara~	","Yemen~+967","Yugoslavia~	","Zambia~+260","Zimbabwe~+263");

function populateCountryCode( countryElementId, codeElementId ,OTPElementId){
	
	var selectedCountryIndex = document.getElementById( countryElementId ).selectedIndex;
	var selectedCountryCode = document.getElementById(countryElementId).options[selectedCountryIndex].getAttribute('data-code');
	document.getElementById( codeElementId ).value = selectedCountryCode;
	
	if( OTPElementId ){
		populateOTP(OTPElementId );
	}
	
	
}

function populateCountries(countryElementId, codeElementId, OTPElementId){
	// given the id of the <select> tag as function argument, it inserts <option> tags
	
	var countryElement = document.getElementById(countryElementId);
	countryElement.length=0;
	countryElement.options[0] = new Option('','-1');
	countryElement.selectedIndex = 0;
	for (var i=0; i<country_arr.length; i++) {
		arrCD = country_arr[i].split('~');
		
		var option = document.createElement("option");
		option.setAttribute("value", arrCD[0].trim());
		option.setAttribute("data-code", arrCD[1].trim());
		option.text = arrCD[0].trim();
		countryElement.appendChild(option);
	}

	// Assigned all countries. Now assign event listener for the states.

	if( codeElementId ){
		countryElement.onchange = function(){
			populateCountryCode( countryElementId, codeElementId ,OTPElementId );
		};
	}
}
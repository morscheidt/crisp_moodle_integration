<?php

function local_crispintegration_before_footer() {
    global $CFG,$PAGE, $USER, $SESSION;
    require_once("$CFG->dirroot/user/profile/lib.php");
    
   
    
    /*$PAGE->requires->js_init_code("alert('before_footer".json_encode(profile_user_record($USER->id))."');");*/ 
    /*$PAGE->requires->js_init_code("alert('before_footer".$custom_profile_record[""]."');"); */

    /*$PAGE->requires->js_init_code("alert('before_footer".$USER->profile_field_Etablissement."');"); */

    $crispWebsiteId = get_config('local_crispintegration','crispWebsiteId');
    $crispSegments = explode(',',get_config('local_crispintegration','crispSegments'));
    
    $crispIntegrationCode  = 'window.$crisp=[];window.CRISP_WEBSITE_ID="'.$crispWebsiteId.'";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();';
    /*$crispIntegrationCode .= 'alert('.json_encode($crispSegments).');';*/ 
    $themeColor='"blue"';
    $crispIntegrationCode .= '$crisp.push(["config", "color:theme", '.$themeColor.']);';
    $crispIntegrationCode .= '$crisp.push(["set", "session:segments", ['.json_encode($crispSegments).']]);';
    $jsCode="console.log('userId:".$USER->id." ');";
    $jsCode.="objectToArray = obj => { const keys = Object.keys(obj);const res = [];for(let i = 0; i < keys.length; i++){res.push([keys[i], obj[keys[i]]]);};return res;};";

    if ($USER->id <> 1 ){
        $fullname=$USER->firstname.' '.$USER->lastname;
        $crispIntegrationCode .= '$crisp.push(["set", "user:nickname", ["'.$fullname.'"]]);';
        $userData =  profile_user_record($USER->id);
        $userData->institution=$USER->institution;
        $userData->auth=$USER->auth;
        
        $jsCode.="var userData =".json_encode($userData).";";
        $PAGE->requires->js_init_code($jsCode);
        
        /*$PAGE->requires->js_init_code("console.log('before_footer : '+ JSON.stringify(objectToArray(userData)));");*/
        
        $crispIntegrationCode .= '$crisp.push(["set", "user:email", ["'.$USER->email.'"]]);'; 
        if (!empty($custom_profile_record["Etablissement"])){
            $crispIntegrationCode .= '$crisp.push(["set", "user:company", [userData[0]["Etablissement"]]]);';
        }
        $crispIntegrationCode .= '$crisp.push(["set", "session:data", [objectToArray(userData)]]);';
    }  
    
    /*$PAGE->requires->js_init_code("alert('before_footer :'+(".json_encode($custom_profile_record).").map(el=>Object.values(el)));"); */
    /*$crispIntegrationCode .= '$crisp.push(["set", "session:data", JSON.stringify('.json_encode($custom_profile_record).')]);';*/
    
    $PAGE->requires->js_init_code($jsCode.$crispIntegrationCode);
    
    
 


}

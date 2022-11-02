
function valid_json_char(json_char){
    // preserve newlines, etc - use valid JSON
    json_char = json_char.replace(/\\n/g, "\\n")  
                        .replace(/\\'/g, "\\'")
                        .replace(/\\"/g, '\\"')
                        .replace(/\\&/g, "\\&")
                        .replace(/\\r/g, "\\r")
                        .replace(/\\t/g, "\\t")
                        .replace(/\\b/g, "\\b")
                        .replace(/\\f/g, "\\f");
    // remove non-printable and other non-valid JSON chars
    json_char = json_char.replace(/[\u0000-\u0019]+/g,""); 
    return json_char;
}

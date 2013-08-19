/*
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-24646575-1']);
_gaq.push(['_setDomainName', 'emergeplus.jp']);
_gaq.push(['_trackPageview']);

(function() {
  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();
*/

/*
 * material json handler
 */
function getMaterialsJSON()
{
  var str = location.href.split("/");
  var url = "http://" + str[2] + "/wp-content/themes/emergeplus/js/materials.json";
  var loc = str[str.length-2];
  if (loc == "materials")
    jQuery.getJSON(url, mapMaterial);
  else if (loc == "ls-preliminary-estimate")
    jQuery.getJSON(url, listMaterial);
}



/*
 * materials.js
 */

jQuery(function() {
  getMaterialsJSON();

  jQuery('a#acryl-modal-btn').click(function() {
    jQuery('#material-radio-btn').attr("data-checked", "1");
  });

  jQuery('a#wood-modal-btn').click(function() {
    jQuery('#material-radio-btn').attr("data-checked", "2");
  });

});

function mapMaterial(json)
{
  var materials = document.getElementById("materials");
  var material = json.material;
  var dom = '';
  var text = '';
  for (i in material) {
    if (i == "0")
      text = '<div class="accordion-group">';
    else
      text += '<div class="accordion-group">';
    text +=  '<div class="accordion-heading">';
    text += '<a class="accordion-toggle" data-toggle="collapse" data-parent="#material" href="#';
    text += material[i].id;
    text += '">';
    text += material[i].name;
    text += '</a>';
    text += '</div>';
    text += '<div id="';
    text += material[i].id;
    text += '" class="accordion-body collapse">';
    text += '<div class="accordion-inner">';
    if ((material[i].id == "cast") || (material[i].id == "extruded"))
      text += getAcrylInfo(material[i]);
    else if ((material[i].id == "mdf") || (material[i].id == "veneer"))
      text += getWoodInfo(material[i]);
    text += '</div>';
    text += '</div>';
    text += '</div>';
  }
  dom = document.createElement("div");
  dom.id = "material";
  dom.className = "accordion";
  dom.innerHTML = text;
  materials.appendChild(dom);
}

function getAcrylInfo(acryl)
{
  var text = '';
  for (var i=0; i<acryl.group.length; i++) {
    text += '<div class="row">';
    text += '<div class="span4">';
    text += '<table class="table" style="margin-left:20px">';
    text += '<tr><th>' + acryl.group[i].name + '</th></tr>';
    for (var j=0; j<acryl.group[i].color.length; j++) {
      text += '<tr><td style="background-color:';
      text += acryl.group[i].color[j].code;
      if (acryl.group[i].color[j].code == "#000")
        text += '; color:#fff';
      text += '">';
      text += acryl.group[i].color[j].name;
      text += '</td></tr>';
    }
    text += '</table>';
    text += '</div>';

    text += '<div class="span7 offset1">';
    text += '<table class="table table-hover">';
    text += '<tr><th>厚さ</th><th>サイズ</th><th>価格</th></tr>';
    for (var index_t=0; index_t<acryl.group[i].thickness.length; index_t++) {
      for (var index_s=0; index_s<acryl.group[i].size.length; index_s++) {
        if (index_s == 0) {
          text += '<tr><td>' + acryl.group[i].thickness[index_t] + 'mm</td>';
          text += '<td>' + acryl.group[i].size[index_s] + '</td>';
        } else if (index_s >= acryl.group[i].size.length-1) {
          text += '<tr><td></td>';
          text += '<td>' + acryl.group[i].size[index_s] + '</td>';
        } else {
          text += '<tr><td></td>';
          text += '<td>' + acryl.group[i].size[index_s] + '</td>';
        }
        if (index_s == 0)
          text += '<td>' + ("¥"+Math.floor((eval(acryl.group[i].value[index_t])*1.2/4))) + '</td></tr>';
        else if (index_s == 1)
          text += '<td>' + ("¥"+Math.floor((eval(acryl.group[i].value[index_t])*1.2/2))) + '</td></tr>';
        else if (index_s == 2)
          text += '<td>¥' + acryl.group[i].value[index_t] + '</td></tr>';
      }
    }
    text += '</table>';
    text += '</div>';
    text += '</div>';
    text += '<br/><br/>';
  }
  return text;
}

function getWoodInfo(wood)
{
    var text = '';
    text += '<div class="row">';
    text += '<div class="span4">';
    text += '<table class="table" style="margin-left:20px">';
    text += '<tr><th>' + wood.name + '</th></tr>';
    for (var j=0; j<wood.color.length; j++) {
      text += '<tr><td style="background-color:';
      text += wood.color[j].code;
      if (wood.color[j].code == "#000")
        text += '; color:#fff';
      text += '">';
      text += wood.color[j].name;
      text += '</td></tr>';
    }
    text += '</table>';
    text += '</div>';

    text += '<div class="span7 offset1">';
    text += '<table class="table table-hover">';
    text += '<tr><th>厚さ</th><th>サイズ</th><th>価格</th></tr>';
    for (var index_t=0; index_t<wood.thickness.length; index_t++) {
      for (var index_s=0; index_s<wood.size.length; index_s++) {
        if (index_s == 0) {
          text += '<tr><td>' + wood.thickness[index_t] + 'mm</td>';
          text += '<td>' + wood.size[index_s] + '</td>';
        } else if (index_s >= wood.size.length-1) {
          text += '<tr><td></td>';
          text += '<td>' + wood.size[index_s] + '</td>';
        } else {
          text += '<tr><td></td>';
          text += '<td>' + wood.size[index_s] + '</td>';
        }
        if (index_s == 0)
          text += '<td>' + ("¥"+Math.floor((eval(wood.value[index_t])*1.2/4))) + '</td></tr>';
        else if (index_s == 1)
          text += '<td>' + ("¥"+Math.floor((eval(wood.value[index_t])*1.2/2))) + '</td></tr>';
        else if (index_s == 2)
          text += '<td>¥' + wood.value[index_t] + '</td></tr>';
      }
    }
    text += '</table>';
    text += '</div>';
    text += '</div>';
    text += '<br/><br/>';
  return text;
}




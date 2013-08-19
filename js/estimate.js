/*
 * estimate.php
 */
jQuery.cookie.json = true;
lsParam = [];

jQuery(function() {

  // オープン時にcookieを読み込んで表示
  readCookie();
  getMaterialsJSON();

  // 1件追加ボタンイベント
  jQuery("#add-lsparam").click(function() {
    // 新しいlsparamをcookieに書き込み
    addNewLsparam();
  });

  // 入力値反映ボタンイベント
  jQuery("#estimate-calc").click(function() {
    if (getEstimateValue() == 0)
      setEstimateToTextarea();
    else
      jQuery('.estimate-text').text('');
    writeLsparam();
  });

  // 削除ボタンイベント
  jQuery(".delete").live("click", false, function(){
    if (jQuery(':focus').length == 0) {
      delOneLsparam(this);
    }
    return false;
  });
});

function readCookie() {
  lsParam = jQuery.cookie("jsonData");

  var text = '';
  // cookieがなければ空の1件を生成して表示
  if ((lsParam == null) || (lsParam.length == 0)) {
    lsParam = [];
    lsParamInit(0);
    // 新たにcookieを書き込む
    jQuery.cookie("jsonData", lsParam);   
    mapEstimateForm(0);
  } else {
    // cookieがあればその内容を設定して表示
    jQuery("#estimate-form").empty();
    for (var i=0; i<lsParam.length; i++) {
      if (countHashAttr(i) < 8) {
        lsParamInit(i);
      }
      mapEstimateForm(i);
    }
  }
  jQuery('#param'+(lsParam.length)).addClass('in');
}

function countHashAttr(i) {
  var cnt = 0;
  for (attr in lsParam[i]) {
    cnt++;
  }
  return cnt;
}

function writeLsparam() {
  if (lsParam.length == 0) {
    lsParamInit(0);
  }
  if (jQuery(".material-sel select").length == 0) {
    jQuery(".material-sel").each(function () {
      jQuery(this).append(selMaterial);
    });
  }

  // もとのcookieを削除
  jQuery.removeCookie("jsonData");
  // 新たにcookieを書き込む
  jQuery.cookie("jsonData", lsParam);   
}

function lsParamInit(i) {
  var obj = {};
  obj.filename = "";
  obj.size = "A5";
  obj.material = "cast clear clear";
  obj.thickness = "0";
  obj.cuttingvol = "1";
  obj.masking = "0";
  obj.smallparts = false;
  obj.millends = false;
  lsParam[i] = obj;
  // mapEstimateForm(i);
}

function addNewLsparam() {
  lsParamInit(lsParam.length);
//  jQuery('.param').each(function(){
//    jQuery('div.acdordion-body',this).removeClass('in');
//  });
  writeLsparam();
  // cookieがあればその内容を設定して表示
  jQuery("#estimate-form").empty();
  for (var i=0; i<lsParam.length; i++) {
    mapEstimateForm(i);
  }
  jQuery('#param'+(lsParam.length)).addClass('in');
}

function delOneLsparam(me) {
  // 確認ダイアログを表示
  var isOk = confirm("削除してよろしいですか？");
  if (isOk == true) {
    var index = parseInt(jQuery(me).closest('form').attr('id').split('form')[1]) - 1;
    // 該当lsparam要素を削除
    lsParam.splice(index, 1);
    if (lsParam.length == 0) {
      lsParamInit(0);
      mapEstimateForm(0);
    }
    // もとのcookieを削除
    jQuery.removeCookie("jsonData");
    // 新たにcookieを書き込む
    jQuery.cookie("jsonData", lsParam);   
/*
    // すべての値を取り込む
    getEstimateValue();
    // 新しいlsparamをcookieに書き込み
    writeLsparam();
    // cookieがあればその内容を設定して表示
*/
    jQuery("#estimate-form").empty();
    for (var i=0; i<lsParam.length; i++) {
      mapEstimateForm(i);
    }
    jQuery('#param'+(lsParam.length)).addClass('in');
  }
}

function mapEstimateForm(i) {
  var inputStr;
  inputStr = ((lsParam[i].filename=="")||(lsParam[i].filename===undefined) ? 'placeholder="ファイル名を入れてください"' : 'value="' + lsParam[i].filename + '"');

  text = '\
  <div class="param accordion-group">\
    <div class="accordion-heading">\
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#estimate-form" href="#param' + (i+1) + '">加工データ' + (i+1) + '</a>\
    </div>\
    <div id="param' + (i+1) + '" class="accordion-body collapse">\
      <div class="accordion-inner">\
        <form id="form' + (i+1) + '">\
        <table class="table">\
          <tr>\
            <th class="filename-color span4">加工ファイル名</th>\
            <td><input class="filename" type="text" ' + inputStr + '></td>\
          </tr>\
          <tr>\
            <td class="cutting-size-color">加工サイズ</td>\
            <td>\
              <label class="radio"><input type="radio" name="cutting-size" value="A5"> A5 (210x148mm)</label>\
              <label class="radio"><input type="radio" name="cutting-size" value="A4"> A4 (297x210mm)</label>\
              <label class="radio"><input type="radio" name="cutting-size" value="A3"> A3 (420x297mm)</label>\
            </td>\
          </tr>\
          <tr>\
            <td class="material-color">材料</td>\
            <td>\
              <div class="material-sel"></div>\
            </td>\
          </tr>\
          <tr>\
            <td class="thickness-color">厚み</td>\
            <td>\
              <div class="thickness-radio">\
              </div>\
            </td>\
          </tr>\
          <tr>\
          <tr class="cut-vol">\
            <td class="cutting-vol-color">加工枚数</td>\
            <td>\
              <div class="input-append"><input class="span4" name="cutting-vol" type="text" value="1" /><span class="add-on">枚</span></div></td>\
          </tr>\
          <tr class="masking-radio">\
            <td class="masking-color">マスキング(ヤニ防止加工)</td>\
            <td>\
              <label class="radio"><input type="radio" name="masking" value="0"> なし</label>\
              <label class="radio"><input type="radio" name="masking" value="1"> 片面</label>\
              <label class="radio"><input type="radio" name="masking" value="2"> 両面</label>\
            </td>\
          </tr>\
          <tr>\
            <td class="small-parts-color">小部品回収</td>\
            <td>\
              <label class="checkbox"><input type="checkbox" name="small-parts"> 必要ならチェック</label>\
            </td>\
          </tr>\
          <tr>\
            <td id="mill-ends-color">端材回収</td>\
            <td>\
              <label class="checkbox"><input type="checkbox" name="mill-ends"> 必要ならチェック</label>\
            </td>\
          </tr>\
          <tr>\
            <td></td><td><button class="btn delete">削除</button></td>\
          </tr>\
        </table>\
        </form>\
      </div>\
    </div>\
  </div>\
  ';

  jQuery("#estimate-form").append(text);

  jQuery('#form'+(i+1)+' input[name="cutting-size"]').val([lsParam[i].size]);
  
  setMaterial(mat);

  jQuery('#form'+(i+1)+' input[name="cutting-vol"]').val(lsParam[i].cuttingvol);

  jQuery('#form'+(i+1)+' input[name="masking"]').val([lsParam[i].masking]);

  if (lsParam[i].smallparts == true)
    jQuery('#form'+(i+1)+' input[name="small-parts"]').attr("checked", true);
  if (lsParam[i].millends == true)
    jQuery('#form'+(i+1)+' input[name="mill-ends"]').attr("checked", true);


}

jQuery('select[name="selmat"]').live("change", function(){
  var index = parseInt(jQuery(this).closest('form').attr('id').split('form')[1]) - 1;
  jQuery(this).parents('form').find('.thickness-radio').empty();
  lsParam[index].material = this.value;
  changeMaterialParam(index);
});

var mat = {};

function listMaterial(json) {
  mat = json.material;
  setMaterial(mat);
}


function setMaterial(mat) {
  jQuery('.material-sel').empty();
  
  selMaterial = '<select name="selmat">';

  for (var i=0; i<mat.length; i++) {
    selMaterial += '<option disabled></option>';
    selMaterial += '<option disabled>';
    selMaterial += mat[i].name;
    selMaterial += '</option>';
    if ((mat[i].id == "cast") || (mat[i].id == "extruded")) {
      for (var j=0; j<mat[i].group.length; j++) {
        for (var k=0; k<mat[i].group[j].color.length; k++) {
          selMaterial += '<option value="' + mat[i].id + ' ' + mat[i].group[j].id + ' ' + mat[i].group[j].color[k].id + '"> -- ' + mat[i].group[j].color[k].name + '</option>';
        }
      }
    } else if ((mat[i].id == "mdf") || (mat[i].id == "veneer")) {
      for (var j=0; j<mat[i].color.length; j++) {
          selMaterial += '<option value="' + mat[i].id + ' ' + mat[i].color[j].id + '"> -- ' + mat[i].color[j].name + '</option>';
      }
    }
  }
  selMaterial += '</select>';
  jQuery(".material-sel").each(function() {
    jQuery(this).append(selMaterial);
  });
  for (var i=0; i<lsParam.length; i++) {
    changeMaterialParam(i);
  }
}

function changeMaterialParam(i) {
  var setThicknessRadio = '';

  jQuery('#form'+(i+1) + ' .thickness-radio').empty();
  jQuery('#form'+(i+1) + ' .masking-radio').hide();
  jQuery('#form'+(i+1) + ' select[name="selmat"]').val(lsParam[i].material);
  var m = lsParam[i].material.split(' ');
  Out:for (var j=0; j<mat.length; j++) {
    if ((mat[j].id == "cast") || (mat[j].id == "extruded")) {
      for (var k=0; k<mat[j].group.length; k++) {
        if (mat[j].group[k].id == m[1]) {
          for (var l=0; l<mat[j].group[k].thickness.length; l++) {
            setThicknessRadio += '<label class="radio thickness-vol"><input type="radio" name="thickness" value="' + l + '"> ' + mat[j].group[k].thickness[l] + 'mm</label>';
            // setThicknessRadio += '<label class="radio thickness-vol"><input type="radio" name="thickness" value="' + mat[j].group[k].thickness[l] + '"> ' + mat[j].group[k].thickness[l] + 'mm</label>';
          }
          jQuery('#form'+(i+1) + ' .thickness-radio').append(setThicknessRadio);
          jQuery('#form'+(i+1) + ' input[name="thickness"]').val([lsParam[i].thickness]);
          break Out;
        }
      }
    } else if((mat[j].id == "mdf") || (mat[j].id == "veneer")) {
      if (mat[j].id == m[0]) {
        for (var k=0; k<mat[j].thickness.length; k++) {
            setThicknessRadio += '<label class="radio thickness-vol"><input type="radio" name="thickness" value="' + k + '"> ' + mat[j].thickness[k] + 'mm</label>';
            // setThicknessRadio += '<label class="radio thickness-vol"><input type="radio" name="thickness" value="' + mat[j].thickness[k] + '"> ' + mat[j].thickness[k] + 'mm</label>';
          
        }
        jQuery('#form'+(i+1) + ' .thickness-radio').append(setThicknessRadio);
        jQuery('#form'+(i+1) + ' input[name="thickness"]').val([lsParam[i].thickness]);
        jQuery('#form'+(i+1) + ' .masking-radio').show();
        break Out;
      }
    }
  }
}


function getEstimateValue() {

  var errorCheck = 0;

  // エラー表示を消去
  jQuery('#error-info').remove();
  // lsParam = [];
  var i = 0;
  jQuery('#estimate-form .param').each(function (){
    // lsParam[i] = {};
    // 加工ファイル名取得
    if ((jQuery(this).find('.filename').val() != undefined) && (jQuery(this).find('.filename').val() != "")) {
      jQuery(this).find('.filename-color').css('color','black');
      jQuery(this).find('.filename-color').text("加工ファイル名");
      lsParam[i].filename = jQuery(this).find('.filename').val();
    } else {
      errorCheck = 1;
      jQuery(this).find('.filename-color').css('color','red');
      jQuery(this).find('.filename-color').text("加工ファイル名");
      lsParam[i].filename = "";
    }
    // 加工サイズ
    if ((lsParam[i].size = jQuery('#form'+(i+1) + ' input[name="cutting-size"]:checked').val()) != undefined) {
      jQuery(this).find('.cutting-size-color').css('color','black');
    } else {
      errorCheck = 1;
      jQuery(this).find('.cutting-size-color').css('color','red');
    }
    // 材料取得取得
    if ((lsParam[i].material = jQuery('#form'+(i+1) + ' option:selected').val()) != undefined) {
      jQuery(this).find('.material-color').css('color','black');
    } else {
      errorCheck = 1;
      jQuery(this).find('.material-color').css('color','red');
    }
    // 厚さ取得
    if ((lsParam[i].thickness = jQuery('#form'+(i+1) + ' input[name="thickness"]:checked').val()) != undefined) {
      jQuery(this).find('.thickness-color').css('color','black');
    } else {
      errorCheck = 1;
      jQuery(this).find('.thickness-color').css('color','red');
    }
    // 加工枚数取得
    if ((lsParam[i].cuttingvol = jQuery('#form' + (i+1) + ' input[name="cutting-vol"]').val()) != "") {
      jQuery(this).find('.cutting-vol-color').css('color','black');
    } else {
      errorCheck = 1;
      jQuery(this).find('.cutting-vol-color').css('color','red');
    }
    // マスキング取得
    if (jQuery('#form'+(i+1) + ' input[name="masking"]').size() > 0) {
      if ((lsParam[i].masking = jQuery('#form'+(i+1) + ' input[name="masking"]:checked').val()) != undefined) {
        jQuery(this).find('.masking-color').css('color','black');
      } else {
        errorCheck = 1;
        jQuery(this).find('.masking-color').css('color','red');
      }
    }
    // 小部品回収取得
    lsParam[i].smallparts = jQuery('#form'+(i+1) + ' input[name="small-parts"]').is(':checked');
    // 端材回収取得
    lsParam[i].millends = jQuery('#form'+(i+1) + ' input[name="mill-ends"]').is(':checked');
    
    i++;
  });

  if (errorCheck) {
    jQuery('#description').after('<div class="alert alert-error" id="error-info">赤字で示されている部分を入力して、「見積もり依頼に反映」ボタンをクリックしてください。</div>');
  }

  return errorCheck;
}

function setEstimateToTextarea() {
  var text = '***********  お見積内容 ***********\n\n';
  var i=0;
  jQuery('#estimate-form .param').each(function() {
    text += '加工データ'+(i+1)+'\n';
    text += '\t加工ファイル名：\t' + jQuery(this).find('.filename').val() + '\n';
    text += '\t加工サイズ：\t\t' +  jQuery('#form'+(i+1) + ' input[name="cutting-size"]:checked').val() + '\n';
    text += '\t材料：\t\t\t';  
    var m = jQuery('#form'+(i+1) + ' option:selected').text().split(' -- ');
    text += m[1] + '\n';
    text += '\t厚さ：\t\t\t';
    text += jQuery('#form'+(i+1) + ' input[name="thickness"]:checked').parent().text().split(' ')[1] + '\n';
    text += '\t加工枚数：\t\t';
    text += jQuery('#form'+(i+1) + ' input[name="cutting-vol"]').val() + '\n';
    if (jQuery('#form'+(i+1) + ' input[name="small-parts"]').is(':checked'))
      text += '\t小部品回収：\t\tあり\n';
    if (jQuery('#form'+(i+1) + ' input[name="mill-ends"]').is(':checked'))
      text += '\t端材回収：\t\tあり\n';
    text += '\n***************************************\n\n';
    i++;
  });

  jQuery('.estimate-text').text(text);
}

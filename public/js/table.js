/*
 * Created on Thu Apr 28 2022
 * Author : Iqbal Atma Muliawan
 * Email  : iqbalatma@gmail.com
 *
 *
 * Copyright (c) 2022 Atmasphere
 */

// export default

const table = {
  setColomnText(row, col, content) {
    $(row).children().eq(col).text(content);
  },

  getColomnText(row, col) {
    return $(row).children().eq(col).text();
  },

  toEditableColomn(ctx) {
    $(ctx).prop("contenteditable", true);
    $(ctx).focus();
  },

  toNextColomnUnit(ctx, event, transObj) {
    if (event.keyCode == 9) {
      event.preventDefault();
      $(ctx).blur();
      $(ctx).next().prop("contenteditable", true);
      $(ctx).next().focus();

      let qty = parseInt($(ctx).next().text().split(" ")[0]);
      transObj.setUnitQuantityTrans(qty);
      $(ctx).next().text(qty);
    }
  },
};

export default table;

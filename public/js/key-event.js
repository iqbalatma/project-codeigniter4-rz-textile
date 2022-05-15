/*
 * Created on Tue May 03 2022
 * Author : Iqbal Atma Muliawan
 * Email  : iqbalatma@gmail.com
 *
 *
 * Copyright (c) 2022 Atmasphere
 */

const keyEvent = {
  preventString(ctx, event) {
    if (event.keyCode == 13) {
      event.preventDefault();
      $(ctx).blur();
    }
    if (event.which < 48 || event.which > 57) {
      event.preventDefault();
    }
  },
};

export default keyEvent;

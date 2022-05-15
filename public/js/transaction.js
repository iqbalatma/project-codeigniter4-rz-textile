const transaction = {
  setSellingPrice(sellingPrice) {
    this.sellingPrice = sellingPrice;
  },

  getSellingPrice() {
    return this.sellingPrice;
  },

  setRollQuantityTrans(quantity) {
    this.rollQuantityTrans = quantity;
  },

  getRollQuantityTrans() {
    return this.rollQuantityTrans;
  },

  setUnitQuantityTrans(quantity) {
    this.unitQuantityTrans = quantity;
  },

  getUnitQuantityTrans() {
    return this.unitQuantityTrans;
  },
};

export default transaction;

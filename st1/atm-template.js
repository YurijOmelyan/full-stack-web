const ATM = {
  isAuth: false,
  currentUser: {},
  // all cash available in ATM
  cash: 2000,
  // all available users
  users: [
    { id: "0000", pin: "000", debet: 100, type: "admin" }, // EXTENDED
    { id: "0025", pin: "123", debet: 675, type: "user" }
  ],
  // authorization
  auth(id, pin) {
    if (this.isAuth) {
      return this.setLog("auth", id, pin, "User authorized");
    }

    for (let index = 0; index < this.users.length; index++) {
      const test =
        Math.abs(String(id).localeCompare(this.users[index].id)) +
        Math.abs(String(pin).localeCompare(this.users[index].pin));

      if (test === 0) {
        this.isAuth = true;
        this.currentUser = {
          userNumber: index,
          type: this.users[index].type
        };
      }
    }

    return this.setLog(
      "auth",
      id,
      pin,
      this.isAuth ? "Login successful" : "Error entering id and pin user"
    );
  },

  // check current debet
  check() {
    if (!this.isAuth) {
      return this.setLog("check", id, pin, "You are not logged in");
    }

    const index = this.currentUser.userNumber;
    const id = this.users[index].id;
    const pin = this.users[index].pin;

    return this.setLog(
      "check",
      id,
      pin,
      `Your available funds: ${this.users[this.currentUser.userNumber].debet}`
    );
  },

  // get cash - available for user only
  getCash(amount) {
    if (!this.isAuth) {
      return this.setLog("getCash", id, pin, "You are not logged in");
    }

    const index = this.currentUser.userNumber;
    const id = this.users[index].id;
    const pin = this.users[index].pin;

    if (this.currentUser.type.localeCompare("admin") === 0) {
      return this.setLog(
        "getCash",
        id,
        pin,
        "Administrator is not allowed to withdraw cash"
      );
    }

    if (!(amount % 10 == 0)) {
      return this.setLog("getCash", id, pin, "Enter a multiple of 10");
    }

    if (this.cash < amount) {
      return this.setLog("getCash", id, pin, "Not enough cash at ATM");
    }

    if (this.users[this.currentUser.userNumber].debet < amount) {
      return this.setLog(
        "getCash",
        id,
        pin,
        "You do not have enough funds on the card!"
      );
    }

    this.users[this.currentUser.userNumber].debet -= amount;
    this.cash -= amount;
    return this.setLog("getCash", id, pin, `Get your money: ${amount}`);
  },

  // load cash - available for user only
  loadCash(amount) {
    if (!this.isAuth) {
      return this.setLog("loadCash", id, pin, "You are not logged in");
    }

    const index = this.currentUser.userNumber;
    const id = this.users[index].id;
    const pin = this.users[index].pin;

    if (this.currentUser.type.localeCompare("admin") === 0) {
      return this.setLog(
        "loadCash",
        id,
        pin,
        "The administrator has no right to invest money"
      );
    }

    if (!(amount % 10 == 0)) {
      return this.setLog("loadCash", id, pin, "Enter a multiple of 10");
    }

    this.users[this.currentUser.userNumber].debet += amount;
    this.cash += amount;
    return this.setLog(
      "loadCash",
      id,
      pin,
      `Successfully credited amount: ${amount}`
    );
  },
  
  // load cash to ATM - available for admin only - EXTENDED
  loadAtmCash(amount) {
    if (!this.isAuth) {
      return this.setLog("loadAtmCash", id, pin, "You are not logged in");
    }

    const index = this.currentUser.userNumber;
    const id = this.users[index].id;
    const pin = this.users[index].pin;

    if (this.currentUser.type.localeCompare("admin") != 0) {
      return this.setLog("loadAtmCash", id, pin, "Available for admin only");
    }

    this.cash += amount;
    return this.setLog("loadAtmCash", id, pin, `Successfully added ${amount}`);
  },

  // get cash actions logs - available for admin only - EXTENDED
  getLogs() {
    if (!this.isAuth) {
      return this.setLog("getLogs", id, pin, "You are not logged in");
    }

    const index = this.currentUser.userNumber;
    const id = this.users[index].id;
    const pin = this.users[index].pin;

    if (this.currentUser.type.localeCompare("admin") != 0) {
      return this.setLog("getLogs", id, pin, "Available for admin only");
    }

    this.setLog("getLogs", id, pin, "Show log list");
    return this.logs;
  },

  // log out
  logout() {
    const index = this.currentUser.userNumber;
    const id = this.users[index].id;
    const pin = this.users[index].pin;

    this.isAuth = false;
    this.currentUser = {};
    return this.setLog("logout", id, pin, `Goodbye ${this.users[index].type}`);
  },

  setLog(method, id, pin, message) {
    if (typeof this.logs === "undefined") {
      this.logs = [];
    }
    this.logs.push({
      operation: method,
      idUser: id,
      pinUser: pin,
      mess: message
    });
    return message;
  }
};

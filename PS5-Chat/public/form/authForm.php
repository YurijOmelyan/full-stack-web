<form>
    <div class="block">
        <div class="form--login__user--name user--name__box">
            <label for="userName"> Enter your name</label>
            <input id="userName" class="input--box" type="text" name="userName" placeholder="John Doe">
            <div id="errorUserName" class="error hide--error"></div>
        </div>
        <div class="form--login__user--pass user--pass__box">
            <label for="userPass">Enter your password </label>
            <input id="userPass" class="input--box" type="password" name="userPass" minlength="6" maxlength="16">
            <div id="errorPass" class="error hide--error"></div>

        </div>
        <div class="form--login__button">
            <input class="input--button font--color" type="submit" value="Submit">
        </div>
    </div>
    <div class="button--shadow"></div>

    <script src="public/js/userAuthorization.js"></script>
</form>
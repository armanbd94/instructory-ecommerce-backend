import Token from './Token'
import AppStorage from './AppStorage'


class User {

    responseAfterLogin(res) {
        const access_token = res.token;
        const user = res.user;
        if (Token.isValid(access_token)) {
            AppStorage.store(access_token, user)
        }
    }

    userInfo()
    {
        let user = AppStorage.getUser();
        return JSON.parse(user);
    }

}

export default User = new User()

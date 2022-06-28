import Token from './Token'
import AppStorage from './AppStorage'


class User {

    responseAfterLogin(res) {
		console.log(res);
        const access_token = res.token;
        const user = res.user;
        if (Token.isValid(access_token)) {
            AppStorage.store(access_token, user)
        }
    }

}

export default User = new User()

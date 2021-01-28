class AppStorage {
    storeUser(user) {
        localStorage.setItem('user', user);
    }

    storeToken(token) {
        localStorage.setItem('token', token)
    }

    store(user, token) {
        this.storeToken(token);
        this.storeUser(user);
    }

    clear() {
        localStorage.removeItem('user');
        localStorage.removeItem('token');
    }

    getToken() {
        return localStorage.getItem('token');
    }

    getUser() {
        return localStorage.getItem('user');
    }

}

export default new AppStorage();

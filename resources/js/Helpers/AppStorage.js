class AppStorage{
    storeToken(token){
        localStorage.setItem('token', token);
    }
    storeUser(user){
        localStorage.setItem('user', user);
    }
    store(token, user){
        this.storeToken(token)
        this.storeUser(user)
    }
    clear(){
        localStorage.removeItem('token')
        localStorage.removeItem('user')
    }
    getToken(){
        localStorage.setItem(token);
    }
    getUser(){
        localStorage.setItem(user);
    }

}
export default AppStorage = new AppStorage();

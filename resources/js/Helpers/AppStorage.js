class AppStorage{
    storeToken(token){
        localforage.getItem('token', token);
    }
    storeUser(user){
        localforage.getItem('user', user);
    }
    store(token, user){
        this.storeToken(token)
        this.storeUser(user)
    }
    clear(){
        localforage.removeItem(token)
        localforage.removeItem(user)
    }
    getToken(){
        localforage.getItem(token);
    }
    getUser(){
        localforage.getItem(user);
    }

}
export default AppStorage = new AppStorage();

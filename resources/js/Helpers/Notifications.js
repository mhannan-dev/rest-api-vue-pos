class Notifications{
    success(){
        new Noty({
        type: 'success',
        text: 'Successfully done',
        layout: 'topRight',
        timeout: 1000,
        }).show();
    }
    cart_delete(){
        new Noty({
        type: 'success',
        text: 'Successfully delete this item from cart',
        layout: 'topRight',
        timeout: 1000,
        }).show();
    }
    cart_success(){
        new Noty({
        type: 'success',
        text: 'Successfully added to cart',
        layout: 'topRight',
        timeout: 1000,
        }).show();
    }
    error(){
        new Noty({
        type: 'alert',
        text: 'Something wrong',
        layout: 'topRight',
        timeout: 1000,
        }).show();
    }
    warning(){
        new Noty({
        type: 'warning',
        text: 'Something wrong',
        layout: 'topRight',
        timeout: 1000,
        }).show();
    }
    imageValidation(){
        new Noty({
        type: 'error',
        text: 'Upload image less than 1MB',
        layout: 'topRight',
        timeout: 1000,
        }).show();
    }
}
export default Notifications = new Notifications()

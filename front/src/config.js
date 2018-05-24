export const apiDomain = 'http://127.0.0.1:8000/'

export const registerUrl = apiDomain + 'api/register'

export const loginUrl = apiDomain + 'api/oauth/token'

export const userUrl = apiDomain + 'api/user'

export const activateUrl = apiDomain + 'api/activate'

export const publishphoto = apiDomain + 'api/photo'

export const photo = apiDomain + 'api/photo/home'

export const photos = apiDomain + 'api/photos' 

export const semdMailUrl = apiDomain + 'api/sendmail'

export const confirmInvite = apiDomain + 'api/confirmInvite'

export const getHeader = function(){
    const tokenData = JSON.parse(window.localStorage.getItem('authUser'))
    const headers = {
        'Accept': 'applicatin/json',
        'Authorization': 'Bearer '+ tokenData.access_token
    }
    return headers
}

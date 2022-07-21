const isEmail = (email: string): boolean => {
    const regExp = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return regExp.test(String(email).toLowerCase());
}

const isPhone = (phone: string): boolean => {
    const regExp = /^(\+?[0-9]{1,4})?(\s*[0-9]{3}){3}$/;
    return regExp.test(String(phone).toLowerCase());
}

const isZipCode = (zip: string): boolean => {
    const regExp = /^([0-9]{3}\s?[0-9]{2})$/;
    return regExp.test(String(zip).toLowerCase());
}

const isCompanyId = (id: string): boolean => {
    const regExp = /^[0-9]{4,10}$/;
    return regExp.test(String(id).toLowerCase());
}

const isVatId = (vat: string): boolean => {
    const regExp = /^([A-Za-z]{2})*[0-9]{8,10}$/;
    return regExp.test(String(vat).toLowerCase());
}

export {isEmail, isPhone, isZipCode, isCompanyId, isVatId}
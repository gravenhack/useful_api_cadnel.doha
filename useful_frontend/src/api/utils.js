import axios from "axios";

import config from "./config.js";

const  baseUrl  = config.apiBaseURL ;

function getToken() {

    const user = JSON.parse(localStorage.getItem("user"));

    console.log(baseUrl);

    if (user) {

        return user.token;
        
    }
    return "";
}

const api = axios.create({

    baseURL: baseUrl,

    headers: {

        "Content-Type": "application/json",

        Authorization: getToken()

            ? `Bearer ${getToken()}`
            : ""
    }
});


export const setToken = (token) => {

    localStorage.setItem("token", token);

    api.defaults.headers.Authorization = `Bearer ${token}`;

};



export default api;
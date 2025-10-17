import api from "./utils";

export default {

    async register (data) {

        try {

           const res =  await api.post("/register", data)

            console.log(res.data)

            return res.data

        } catch (e) {

            this.error = e.message;

            console.log(this.error);
            
            return null;
        }
    },

    async login (data) {

        try {
            const res =  await api.post("/login", data)

            localStorage.setItem("user", JSON.stringify( res.data ) );

            console.log(res.data)

            return res.data

        } catch (e) {

            this.error = e.message;

            console.log(this.error);
            
            return null;
        }
    }

};
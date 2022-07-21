import axios from "axios";

export default () => axios.create({
    //@ts-ignore
    baseURL: window.envs.OLD_API_URL,
});
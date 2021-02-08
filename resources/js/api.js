import axios from "axios";
import store from "./store";

const host = "http://172.16.101.119/demo/public/api";
// Auth api create
const authRequest = axios.create({
  baseURL: host + "/auth"
});
authRequest.interceptors.request.use(config => {
  store.commit("loaded", true);
  return config;
});
authRequest.interceptors.response.use(
  response => {
    store.commit("loaded", false);
    return response;
  },
  error => {
    store.commit("loaded", false);
    return Promise.reject(error);
  }
);

// User api create
const userRequest = axios.create({
  baseURL: host + "/user"
});
userRequest.interceptors.request.use(config => {
  if (localStorage.getItem("access_token"))
    config.headers["Authorization"] =
      "Bearer " + localStorage.getItem("access_token");
  else store.commit("setLogout", true);
  store.commit("loaded", true);
  return config;
});
userRequest.interceptors.response.use(
  response => {
    store.commit("loaded", false);
    return response;
  },
  error => {
    store.commit("loaded", false);
    return Promise.reject(error);
  }
);

// Manage api create
const manageRequest = axios.create({
  baseURL: host + "/manage"
});
manageRequest.interceptors.request.use(config => {
  if (localStorage.getItem("access_token"))
    config.headers["Authorization"] =
      "Bearer " + localStorage.getItem("access_token");
  else store.commit("setLogout", true);
  store.commit("loaded", true);
  return config;
});
manageRequest.interceptors.response.use(
  response => {
    store.commit("loaded", false);
    return response;
  },
  error => {
    store.commit("loaded", false);
    return Promise.reject(error);
  }
);

// Guest api create
const guestRequest = axios.create({
  baseURL: host + "/guest"
});
guestRequest.interceptors.request.use(config => {
  store.commit("loaded", true);
  return config;
});
guestRequest.interceptors.response.use(
  response => {
    store.commit("loaded", false);
    return response;
  },
  error => {
    store.commit("loaded", false);
    return Promise.reject(error);
  }
);

// Auth 相關的 api
export const apiUserRegister = data => authRequest.post("/register", data);
export const apiUserLogin = data => authRequest.post("/login", data);

// User 相關的 api
export const apiUserLogout = data => userRequest.post("/logout", data);
export const apiUserRefresh = data => userRequest.post("/refresh", data);
export const apiUserProfile = () => userRequest.get("/profile");

// Wedding 相關的 api
export const apiGetWeddings = () => manageRequest.get("/weddings");
export const apiGetWedding = id => manageRequest.get("/weddings/" + id);
export const apiAddWedding = data => manageRequest.post("/weddings", data);
export const apiEditWedding = (id, data) =>
  manageRequest.put("/weddings/" + id, data);
export const apiDelWedding = id => manageRequest.delete("/weddings/" + id);

// Guest 相關的 api
export const apiGetGuests = () => manageRequest.get("/guests");
export const apiAddGuest = data => manageRequest.post("/guests", data);
export const apiEditGuest = (id, data) =>
  manageRequest.put("/guests/" + id, data);
export const apiDelGuest = id => manageRequest.delete("/guests/" + id);

// Form 相關的 api
export const apiGetForms = () => manageRequest.get("/forms");
export const apiGetForm = id => manageRequest.get("/forms/" + id);
export const apiAddForm = data => manageRequest.post("/forms", data);
export const apiEditForm = (id, data) =>
  manageRequest.put("/forms/" + id, data);
export const apiDelForm = id => manageRequest.delete("/forms/" + id);

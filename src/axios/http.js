import axios from "axios";
 
export default axios.create({
  // baseURL: "https://laravel-ta.herokuapp.com/api",
  baseURL: "http://localhost:8000/api",
  headers: {
    "Content-type": "application/json",
  }
});
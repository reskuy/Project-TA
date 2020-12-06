import axios from "axios";
 
export default axios.create({
  baseURL: "https://laravel-ta.herokuapp.com/api",
  headers: {
    "Content-type": "application/json",
  }
});
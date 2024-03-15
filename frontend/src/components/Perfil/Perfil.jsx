import { useNavigate } from "react-router-dom";
import React, { useState } from "react";
import { useEffect } from "react";
import Info from "./Info";

export const Perfil = () => {
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [names, setNames] = useState("");
  const [first_LastName, setFirst_LastName] = useState("");
  const [second_LastName, setSecond_LastName] = useState("");
  const [birthday, setBirthday] = useState("");
  const [userData, setUserData] = useState(null);
  const navigate = useNavigate();
  useEffect(() => {
    const token = localStorage.getItem("token");
    if (!token) {
      navigate("/");
    }
  }, [navigate]);

  useEffect(() => {
    const userDataString = localStorage.getItem("InfoUser");
    if (userDataString) {
      const userData = JSON.parse(userDataString);
      setUserData(userData);
    }
  }, []);

  const handleSubmit = (event) => {
    event.preventDefault();

    const data = {
      email: email,
      password: password,
      names: names,
      first_LastName: first_LastName,
      second_LastName: second_LastName,
      birthday: birthday,
    };

    fetch(`http://127.0.0.1:8000/api/users/${userData.id}`, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        console.log(data);
        localStorage.setItem("InfoUser", JSON.stringify(data));

        setEmail("");
        setPassword("");
        setNames("");
        setFirst_LastName("");
        setSecond_LastName("");
        setBirthday("");

        navigate(`/LayoutAdmin/Perfil/${userData.id}`);
      })
      .catch((error) => {
        console.error("There was an error!", error);
      });
    <div className="hidden">
      <Info userData1={data} />
    </div>;
  };

  return (
    <>
      <div className=" w-[100%] pt-4 m-auto mt-8 relative ">
        <a
          href="/LayoutAdmin/Info"
          className="text-sky-500 absolute left-[120px] top-0 "
        >
          Atrás
        </a>
        <section className="">
          <section className="w-[80%] rounded-[12px] border-gray-400 border-[1px] mt-[10px] px-[40px] bg-white ">
            <h2 className="text-[24px] mt-[25px]">Cambiar Informacion</h2>

            <form onSubmit={handleSubmit}>
              <div className="my-[15px]">
                <label htmlFor="email" className="text-gray-800">
                  Usuario/Correo
                </label>
                <br />
                <div className="w-[400px] h-[45px] rounded-[12px] border-[1px] border-gray-400 mt-[5px] items-center flex bg ">
                  <input
                    type="text"
                    id="email"
                    name="email"
                    placeholder="Escriba su correo.."
                    className="focus:outline-none w-[90%] h-[80%] px-3 bg-transparent"
                    autoComplete="off"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                  />
                  <br />
                </div>
              </div>

              <div className="my-[15px]">
                <label htmlFor="names" className="text-gray-800">
                  Nombres
                </label>
                <br />
                <div className="w-[400px] h-[45px] rounded-[12px] border-[1px] border-gray-400 mt-[5px] items-center flex ">
                  <input
                    type="text"
                    id="names"
                    name="names"
                    placeholder="Escriba su nombres.."
                    className=" focus:outline-none w-[90%] h-[80%] px-3 bg-transparent"
                    autoComplete="off"
                    value={names}
                    onChange={(e) => setNames(e.target.value)}
                  />
                  <br />
                </div>
              </div>
              <div className="my-[15px]">
                <label htmlFor="first_LastName" className="text-gray-800">
                  Primer Apellido
                </label>
                <br />
                <div className="w-[400px] h-[45px] rounded-[12px] border-[1px] border-gray-400 mt-[5px] items-center flex ">
                  <input
                    type="text"
                    id="first_LastName"
                    name="first_LastName"
                    placeholder="Escriba su primer apellido.."
                    className=" focus:outline-none w-[90%] h-[80%] px-3 bg-transparent"
                    autoComplete="off"
                    value={first_LastName}
                    onChange={(e) => setFirst_LastName(e.target.value)}
                  />
                  <br />
                </div>
              </div>
              <div className="my-[15px]">
                <label htmlFor="second_LastName	" className="text-gray-800">
                  Segundo Apellido
                </label>
                <br />
                <div className="w-[400px] h-[45px] rounded-[12px] border-[1px] border-gray-400 mt-[5px] items-center flex ">
                  <input
                    type="text"
                    id="second_LastName	"
                    name="second_LastName	"
                    placeholder="Escriba su segundo apellido.."
                    className=" focus:outline-none w-[90%] h-[80%] px-3 bg-transparent"
                    autoComplete="off"
                    value={second_LastName}
                    onChange={(e) => setSecond_LastName(e.target.value)}
                  />
                  <br />
                </div>
              </div>

              <div className="my-[15px]">
                <label htmlFor="birthday" className="text-gray-800">
                  Fecha de Nacimiento
                </label>
                <br />
                <div className="w-[400px] h-[45px] rounded-[12px] border-[1px] border-gray-400 mt-[5px] items-center flex ">
                  <input
                    type="date"
                    id="birthday"
                    name="birthday"
                    placeholder="Escriba su fecha de nacimiento.."
                    className=" focus:outline-none w-[90%] h-[80%] px-3 bg-transparent"
                    autoComplete="off"
                    value={birthday}
                    onChange={(e) => setBirthday(e.target.value)}
                  />
                  <br />
                </div>
              </div>

              <div className="my-[15px]">
                <label htmlFor="password" className="text-gray-800">
                  Contraseña
                </label>
                <br />
                <div className="w-[400px] h-[45px] rounded-[12px] border-[1px] border-gray-400 mt-[5px] items-center flex ">
                  <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Escriba su contraseña.."
                    className=" focus:outline-none w-[90%] h-[80%] px-3 bg-transparent"
                    autoComplete="off"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                  />
                  <br />
                </div>
              </div>
              <button
                type="submit"
                className=" w-[82px] h-[38px] rounded-[8px] bg-sky-500 text-white text-[16px] mt-[15px] hover:bg-sky-400 mb-[50px]"
              >
                Guardar
              </button>
            </form>
          </section>
        </section>
      </div>
    </>
  );
};

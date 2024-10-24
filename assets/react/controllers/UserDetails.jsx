import React, { useState, useEffect } from "react";

export default function UserDetails(props) {
  //   const id = window.location.pathname.split("/").pop();
  const id = props.id;
  // const [user, setUser] = useState([]);
  // const [possessions, setPossessions] = useState([]);
  const [data, setData] = useState({ user: {}, possessions: [] });

  useEffect(() => {
    fetch(`/api/users/${id}`)
      .then((response) => response.json())

      .then((data) => {
        // setUser(data["user"]);
        // setPossessions(data["possessions"]);
        setData(data);
      });
  }, []);

  // Créer une requête
  return (
    <div className="container mt-4">
      <h2>
        Informations de  {data.user.Prenom} {data.user.Nom}
        {/* {user.Prenom} {user.Nom} */}
      </h2>
      <p>Email : {data.user.Email}</p>
      <p>Adresse : {data.user.Adresse}</p>
      <h3>Ses possessions</h3>
      <table className="table table-striped">
        <thead>
          <tr>
            <th className="custom-header-color">Nom</th>
            <th className="custom-header-color">Valeur</th>
            <th className="custom-header-color">Type</th>
          </tr>
        </thead>
        <tbody>
          {data.possessions.map((possession) => (
            <tr key={possession.id}>
              <td>{possession.nom}</td>
              <td>{possession.valeur}</td>
              <td>{possession.type}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}

import React, { useState, useEffect } from "react";


export default function UserList() {
  const [users, setUsers] = useState([]);

  useEffect(() => {
    fetch("/api/users")
      .then((response) => response.json() )
      .then((data) => setUsers(data));

  }, []);

  const handleDelete = (id) => {
    fetch(`/api/users/${id}`, { method: "DELETE" })
      // .then(() => setUsers(users.filter(user => user.id !== id)));
      .then(response => {
        if (response.ok) {
          setUsers(users.filter(user => user.id !== id));
        } else {
          console.error('Erreur lors de la suppression de l\'utilisateur');
        }
      })

      // const handleDelete = (id) => {
      //   fetch(`/api/users/${id}`, {
      //     method: 'DELETE',
      //     headers: {
      //       'Content-Type': 'application/json',
      //     },
      //   })
      //     .then(response => {
      //       if (response.ok) {
      //         setUsers(users.filter(user => user.id !== id));
      //       } else {
      //         console.error('Erreur lors de la suppression de l\'utilisateur');
      //       }
      //     })
      //     .catch(error => {
      //       console.error('Erreur de connexion avec l\'API', error);
      //     });
      // };
}

  return (
    <div className="container mt-4">
      <table className="table table-striped">
        <thead>
          <tr>
            <th className="custom-header-color">Nom</th>
            <th className="custom-header-color">Prénom</th>
            <th className="custom-header-color">Email</th>
            <th className="custom-header-color">Adresse</th>
            <th className="custom-header-color">Téléphone</th>
            <th className="custom-header-color">Age</th>
            <th className="custom-header-color">Actions</th>
          </tr>
        </thead>
        <tbody>
          {users.map((user) => (
            <tr key={user.id}>
              <td><a href={`/user/${user.id}`}>{user.Nom}</a></td>
              <td>{user.Prenom}</td>
              <td>{user.Email}</td>
              <td>{user.Adresse}</td>
              <td>{user.Tel}</td>
              <td>{user.Age}</td>
              <td>
                <button
                  onClick={() => handleDelete(user.id)}
                  className="btn btn-danger btn-sm"
                >
                  Supprimer
                </button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}

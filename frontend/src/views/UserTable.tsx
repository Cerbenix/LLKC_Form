import React, { useEffect, useRef, useState } from "react";
import $ from "jquery";
import "datatables.net-dt";
import "datatables.net-dt/css/jquery.dataTables.css";

interface User {
  id: number;
  name: string;
  surname: string;
  email: string;
  address: string;
  city: string;
  postalCode: string;
  phone: string;
  smoking: string;
  hobbies: string[];
  employedFrom: string;
  employedTo: string;
  comments: string;
}

const UserTable: React.FC = () => {
  const tableRef = useRef<HTMLTableElement | null>(null);
  const [users, setUsers] = useState<User[]>([]);

  useEffect(() => {
    fetchUsers();
  }, []);

  useEffect(() => {
    if (tableRef.current) {
      const dataTable = $(tableRef.current).DataTable();
      dataTable.clear();

      users.forEach((user) => {
        const rowData = [
          user.name,
          user.surname,
          user.email,
          user.address,
          user.city,
          user.postalCode,
          user.phone,
          user.smoking,
          user.hobbies.join(", "),
          user.employedFrom,
          user.employedTo,
          user.comments
        ];

        dataTable.row.add(rowData);
      });

      dataTable.draw();
    }
  }, [users]);

  const fetchUsers = async () => {
    try {
      const response = await fetch("/api/user");
      const data = await response.json();

      const formattedUsers: User[] = data.map((user: User) => {
        const formattedEmployedFrom = new Date(user.employedFrom).toLocaleDateString();
        const formattedEmployedTo = new Date(user.employedTo).toLocaleDateString();

        return {
          ...user,
          employedFrom: formattedEmployedFrom,
          employedTo: formattedEmployedTo,
        };
      });

      setUsers(formattedUsers);
    } catch (error) {
      console.error("Error fetching users:", error);
    }
  };

  return (
    <div className="flex justify-center mt-10">
      <table ref={tableRef}>
        <thead>
          <tr>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Address</th>
            <th>City</th>
            <th>Postal Code</th>
            <th>Phone Number</th>
            <th>Smoker</th>
            <th>Hobbies</th>
            <th>Employed From</th>
            <th>Employed To</th>
            <th>Comments</th>
          </tr>
        </thead>
        <tbody>
          {users.map((user) => (
            <tr key={user.id}>
              <td>{user.name}</td>
              <td>{user.surname}</td>
              <td>{user.email}</td>
              <td>{user.address}</td>
              <td>{user.city}</td>
              <td>{user.postalCode}</td>
              <td>{user.phone}</td>
              <td>{user.smoking}</td>
              <td>{user.hobbies.join(", ")}</td>
              <td>{user.employedFrom}</td>
              <td>{user.employedTo}</td>
              <td>{user.comments}</td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default UserTable;

using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Data;
using System.Data.SqlClient;
using System.Configuration;

namespace test02
{
    public class TicketsNodesNames
    {
        public string Node { get; set; }
        public string ip_address { get; set; }
    }    

    public class TicketNodesDataAccessNameIP
    {
        public static List<TicketsNodesNames> GetAllNodesServicesIP(int TicketID, string determinant)
            {
                List<TicketsNodesNames> listTicketsNode = new List<TicketsNodesNames>();

                using (SqlConnection con = new SqlConnection(@"Data Source=STPSITE01\STPSQLSRV;Initial Catalog=massive_problems;Persist Security Info=True;тут был пользователь и пароль"))
                {
                    SqlCommand cmd = new SqlCommand("SELECT DISTINCT Node.name, Node.ip_address FROM Tickets_nodes INNER JOIN Node ON Tickets_nodes.id_node = Node.id WHERE id_ticket = @TicketID", con);
                    SqlParameter parameter = new SqlParameter();
                    parameter.ParameterName = "@TicketID";
                    parameter.Value = TicketID;
                    cmd.Parameters.Add(parameter);

                    con.Open();
                    SqlDataReader rdr = cmd.ExecuteReader();
                    while (rdr.Read())
                    {
                        TicketsNodesNames TicketsNodes = new TicketsNodesNames();
                        TicketsNodes.Node = Convert.ToString(rdr["name"]);
                        TicketsNodes.ip_address = Convert.ToString(rdr["ip_address"]);
                        listTicketsNode.Add(TicketsNodes);
                    }
                }

                return listTicketsNode;
            }
        
    }
}
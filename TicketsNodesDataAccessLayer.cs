using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Data;
using System.Data.SqlClient;
using System.Configuration;

namespace test02
{
    

    public class TicketsNodes
    {
        //public string ip_address { get; set; }
        public string Node { get; set; }
    }


    public class TicketsNodesDataAccessLayer
    {
        public static List<TicketsNodes> GetAllNodesServices(int TicketID, string determinant)
        {
            List<TicketsNodes> listTicketsNode = new List<TicketsNodes>();
 
            using (SqlConnection con = new SqlConnection(@"Data Source=STPSITE01\STPSQLSRV;Initial Catalog=massive_problems;Persist Security Info=True;"))
            {
                string sqlrequest = "";
                string sqldata = "";
                if (determinant == "location") { sqldata = "location"; sqlrequest = "Node.location";}
                else { sqldata = "tech"; sqlrequest = "Node.tech"; }
                SqlCommand cmd = new SqlCommand("SELECT DISTINCT "+ sqlrequest + " FROM Tickets_nodes INNER JOIN Node ON Tickets_nodes.id_node = Node.id WHERE id_ticket = @TicketID", con);
                SqlParameter parameter = new SqlParameter();
                parameter.ParameterName = "@TicketID";
                parameter.Value = TicketID;
                cmd.Parameters.Add(parameter);

                con.Open();
                SqlDataReader rdr = cmd.ExecuteReader();
                while (rdr.Read())
                {
                    TicketsNodes TicketsNodes = new TicketsNodes();
                    TicketsNodes.Node = Convert.ToString(rdr[sqldata]);
                    listTicketsNode.Add(TicketsNodes);
                }
            }

            return listTicketsNode;
        }
    }

   
}
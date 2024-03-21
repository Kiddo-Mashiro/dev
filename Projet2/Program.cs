using System;
using MySql.Data.MySqlClient;

namespace ApplicationConsole
{
    class Program
    {
        static void Main(string[] args)
        {
            string connectionString = "Server=localhost;Database=ap;Uid=root;Pwd=;";

            using (MySqlConnection connection = new MySqlConnection(connectionString))
            {
                connection.Open();

                Console.WriteLine("Liste des centres disponibles :");
                string queryCentres = "SELECT id, nom FROM centre";
                using (MySqlCommand command = new MySqlCommand(queryCentres, connection))
                {
                    using (MySqlDataReader reader = command.ExecuteReader())
                    {
                        while (reader.Read())
                        {
                            Console.WriteLine($"{reader.GetInt32("id")}) {reader.GetString("nom")}");
                        }
                    }
                }

                Console.WriteLine("Veuillez sélectionner le centre (entrez le numéro correspondant) :");
                int centreId = int.Parse(Console.ReadLine());

                Console.WriteLine("Options disponibles :");
                string queryOptions = $"SELECT idcentre2, idspe FROM choisir WHERE idcentre2 = {centreId}";
                using (MySqlCommand command = new MySqlCommand(queryOptions, connection))
                {
                    using (MySqlDataReader reader = command.ExecuteReader())
                    {
                        while (reader.Read())
                        {
                            int specialiteId = reader.GetInt32("idspe");
                            string querySpecialite = $"SELECT nom FROM specialite WHERE id = {specialiteId}";
                            using (MySqlCommand innerCommand = new MySqlCommand(querySpecialite, connection))
                            {
                                string specialiteNom = innerCommand.ExecuteScalar().ToString();
                                Console.WriteLine($"{specialiteId}) {specialiteNom}");
                            }
                        }
                    }
                }

                Console.WriteLine("Veuillez choisir une ou plusieurs options (séparées par des virgules) :");
                string[] options = Console.ReadLine().Split(',');

                decimal prixTotalSansRemise = 0;
                foreach (string option in options)
                {
                    string queryTarif = $"SELECT tarif FROM specialite WHERE id = {option}";
                    using (MySqlCommand command = new MySqlCommand(queryTarif, connection))
                    {
                        prixTotalSansRemise += Convert.ToDecimal(command.ExecuteScalar());
                    }
                }

                decimal prixTotalAvecRemise = prixTotalSansRemise;

                string queryRemise = $"SELECT reduc2, reduc3 FROM reduction WHERE idcentre = {centreId}";
                using (MySqlCommand command = new MySqlCommand(queryRemise, connection))
                {
                    using (MySqlDataReader reader = command.ExecuteReader())
                    {
                        if (reader.Read())
                        {
                            decimal remise2 = reader.GetDecimal("reduc2");
                            decimal remise3 = reader.GetDecimal("reduc3");
                            int nombreOptions = options.Length;

                            if (nombreOptions >= 2)
                            {
                                prixTotalAvecRemise -= prixTotalSansRemise * (remise2 / 100);
                            }

                            if (nombreOptions >= 3)
                            {
                                prixTotalAvecRemise -= prixTotalSansRemise * (remise3 / 100);
                            }
                        }
                    }
                }

                Console.WriteLine($"Prix sans remise : {prixTotalSansRemise} €");
                Console.WriteLine($"Prix avec remise : {prixTotalAvecRemise} €");
            }
        }
    }
}

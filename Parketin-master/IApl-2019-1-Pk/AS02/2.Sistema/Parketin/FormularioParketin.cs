using ExcelDataReader;
using Newtonsoft.Json;
using System;
using System.Collections.Generic;
using System.Configuration;
using System.Data;
using System.Data.SqlClient;
using System.IO;
using System.Text;
using System.Web.Script.Serialization;
using System.Windows.Forms;
using System.Xml;
using System.Xml.Linq;
using static System.Net.WebRequestMethods;

namespace Parketin
{
    public partial class FormularioParketin : Form
    {
        public FormularioParketin()
        {
            InitializeComponent();
        }

        private void DownloadTxt_Click(object sender, EventArgs e)
        {

            string connectionString = "Data Source=VAIO-PC\\SQLEXPRESS;initial catalog=Estacionamento;integrated security=True";
            SqlConnection sqlConn = new SqlConnection(connectionString);
            sqlConn.Open();

            using (SqlCommand cmd = new SqlCommand("SELECT * FROM VEICULO"))
            {
                using (SqlDataAdapter sda = new SqlDataAdapter())
                {
                    cmd.Connection = sqlConn;
                    sda.SelectCommand = cmd;


                    using (DataTable dt = new DataTable())
                    {
                        sda.Fill(dt);

                        //Cria um arquivo de texto
                        string txt = string.Empty;

                        foreach (DataColumn column in dt.Columns)
                        {
                            //Adiciona Cabeçalho para as linhas
                            txt += column.ColumnName + "\t\t";
                        }

                        //Adiciona uma nova linha
                        txt += "\r\n\t";

                        foreach (DataRow row in dt.Rows)
                        {
                            foreach (DataColumn column in dt.Columns)
                            {
                                //Adiciona dados nas colunas
                                txt += row[column.ColumnName] + "\t\t";
                            }

                            //Adiciona nova linha.
                            txt += "\r\n";
                        }

                        StreamWriter file = new StreamWriter(@"C:\bin\teste.txt");
                        file.WriteLine(txt.ToString());
                        file.Close();
                        sqlConn.Close();

                        MessageBox.Show("Download realizado com Sucesso!");
                    }
                }
            }
        }

        private void Salvar_Click(object sender, EventArgs e)
        {
            OpenFileDialog open = new OpenFileDialog();
            open.Filter = "Excel file|*.xls;*.xlsx;*.xlsm";

            if (open.ShowDialog() == DialogResult.Cancel)
            {
                return;
            }

            FileStream arquivo = new FileStream(open.FileName, FileMode.Open);
            IExcelDataReader lerExcel = ExcelReaderFactory.CreateOpenXmlReader(arquivo);
            DataSet resultado = lerExcel.AsDataSet();

            PARKETINEntities1 db = new PARKETINEntities1();
            foreach (DataTable tabela in resultado.Tables)
            {

                foreach (DataRow dt in tabela.Rows)
                {

                    VEICULO veiculo = new VEICULO()
                    {
                        ID = Convert.ToInt16(dt[0]),
                        NOME_VEICULO = Convert.ToString(dt[1]),
                        PLACA_VEICULO = Convert.ToString(dt[2]),
                        COR_VEICULO = Convert.ToString(dt[3]),
                        TIPO_VEICULO = Convert.ToString(dt[4]),
                        FABRICANTE = Convert.ToString(dt[5]),
                        MODELO_VEICULO = Convert.ToString(dt[6]),

                    };

                    db.VEICULOes.Add(veiculo);
                }
            }

            db.SaveChanges();

            lerExcel.Close();
            arquivo.Close();

            MessageBox.Show("Envio realizado com sucesso!");
        }

        private void Label2_Click(object sender, EventArgs e)
        {

        }


        private void DownloadJson(object sender, EventArgs e)
        {
            DataTable dt = new DataTable();
            using (SqlConnection con = new SqlConnection("Data Source=VAIO-PC\\SQLEXPRESS;initial catalog=Estacionamento;integrated security=True"))
            {
                using (SqlCommand cmd = new SqlCommand("select IDENTIFICADOR=ID,NOME_VEICULO=NOME_VEICULO,PLACA_VEICULO=PLACA_VEICULO,COR_VEICULO=COR_VEICULO,TIPO_VEICULO=TIPO_VEICULO,FABRICANTE=FABRICANTE,MODELO_VEICULO=MODELO_VEICULO from VEICULO", con))
                {
                    con.Open();
                    SqlDataAdapter da = new SqlDataAdapter(cmd);
                    da.Fill(dt);
                    System.Web.Script.Serialization.JavaScriptSerializer serializer = new System.Web.Script.Serialization.JavaScriptSerializer();
                    List<Dictionary<string, object>> rows = new List<Dictionary<string, object>>();
                    Dictionary<string, object> row;
                    foreach (DataRow dr in dt.Rows)
                    {
                        row = new Dictionary<string, object>();
                        foreach (DataColumn col in dt.Columns)
                        {
                            row.Add(col.ColumnName, dr[col]);
                        }
                        rows.Add(row);
                    }

                    string jsonstring = serializer.Serialize(rows);

                    using (var file = new StreamWriter(@"C:\bin\teste1.javascript", false))
                    {
                        file.Write(jsonstring);
                        file.Close();
                        file.Dispose();
                    }

                    MessageBox.Show("Download realizado com Sucesso!");
                }
            }
        }

        private void UploadJson(object sender, EventArgs e)
        {
            PARKETINEntities1 db = new PARKETINEntities1();
            OpenFileDialog open = new OpenFileDialog();
            open.Filter = "JAVASCRIPT file|*.javascript";

            if (open.ShowDialog() == DialogResult.Cancel)
            {
                return;
            }

            FileStream arquivo = new FileStream(open.FileName, FileMode.Open);

            DataSet resultado = new DataSet();
            VEICULO veiculo = new VEICULO();


            StreamReader sr = new StreamReader(arquivo);
            string jsonString = sr.ReadToEnd();

            List<VEICULO> ro = JsonConvert.DeserializeObject<List<VEICULO>>(jsonString);

            foreach (var item in ro)
            {
                db.VEICULOes.Add(new VEICULO
                {
                    ID = item.ID,
                    NOME_VEICULO = item.NOME_VEICULO,
                    PLACA_VEICULO = item.PLACA_VEICULO,
                    COR_VEICULO = item.COR_VEICULO,
                    TIPO_VEICULO = item.TIPO_VEICULO,
                    FABRICANTE = item.FABRICANTE,
                    MODELO_VEICULO = item.MODELO_VEICULO
                });
            }

            db.SaveChanges();

            arquivo.Close();

            MessageBox.Show("Envio realizado com sucesso!");
        }

        private void DownloadXML(object sender, EventArgs e)
        {

            DataTable dt = new DataTable();
            using (SqlConnection con = new SqlConnection("Data Source=VAIO-PC\\SQLEXPRESS;initial catalog=Estacionamento;integrated security=True"))
            {
                using (SqlCommand cmd = new SqlCommand("select IDENTIFICADOR=ID,NOME_VEICULO=NOME_VEICULO,PLACA_VEICULO=PLACA_VEICULO,COR_VEICULO=COR_VEICULO,TIPO_VEICULO=TIPO_VEICULO,FABRICANTE=FABRICANTE,MODELO_VEICULO=MODELO_VEICULO from VEICULO", con))
                {
                    con.Open();
                    SqlDataAdapter da = new SqlDataAdapter(cmd);
                    da.Fill(dt);
                    DataSet dS = new DataSet();
                    dS.DataSetName = "VEICULO";
                    dS.Tables.Add(dt);
                    StringWriter sw = new StringWriter();
                    dS.WriteXml(sw, XmlWriteMode.IgnoreSchema);
                    string st = sw.ToString();

                    using (var file = new StreamWriter(@"C:\bin\teste2.xml", false))
                    {
                        file.Write(st);
                        file.Close();
                        file.Dispose();
                    }
                }
            }
            MessageBox.Show("Download realizado com sucesso!");
        }

        private void UploadXML(object sender, EventArgs e)
        {
            VEICULO veiculo = new VEICULO();
            PARKETINEntities1 db = new PARKETINEntities1();
            OpenFileDialog open = new OpenFileDialog();
            open.Filter = "XML file|*.xml";

            if (open.ShowDialog() == DialogResult.Cancel)
            {
                return;
            }

            FileStream arquivo = new FileStream(open.FileName, FileMode.Open);
            XmlDocument doc = new XmlDocument();
            doc.Load(arquivo);

            XmlNodeList nodeList = doc.GetElementsByTagName("Table1");


            foreach (XmlNode node in nodeList)
            {

                veiculo.ID = Convert.ToInt32(node.SelectSingleNode("IDENTIFICADOR").InnerText);
                veiculo.NOME_VEICULO = node.SelectSingleNode("NOME_VEICULO").InnerText.ToString();
                veiculo.PLACA_VEICULO = node.SelectSingleNode("PLACA_VEICULO").InnerText.ToString();
                veiculo.COR_VEICULO = node.SelectSingleNode("COR_VEICULO").InnerText.ToString();
                veiculo.TIPO_VEICULO = node.SelectSingleNode("TIPO_VEICULO").InnerText.ToString();
                veiculo.FABRICANTE = node.SelectSingleNode("FABRICANTE").InnerText.ToString();
                veiculo.MODELO_VEICULO = node.SelectSingleNode("MODELO_VEICULO").InnerText.ToString();

                db.VEICULOes.Add(veiculo);
            }

            db.SaveChanges();

            arquivo.Close();

            MessageBox.Show("Envio realizado com sucesso!");
        }
    }
}



using ExcelDataReader;
using System;
using System.Data;
using System.Data.SqlClient;
using System.IO;
using System.Windows.Forms;
using System.Configuration;
using System.Text;

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

            string connectionString = "Data Source=DESKTOP-TKCJ64E\\SQLEXPRESS;initial catalog=PARKETIN;integrated security=True";
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
    }
}

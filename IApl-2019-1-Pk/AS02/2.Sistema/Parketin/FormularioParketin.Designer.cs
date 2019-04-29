namespace Parketin
{
    partial class FormularioParketin
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.DownloadTxt = new System.Windows.Forms.Button();
            this.Salvar = new System.Windows.Forms.Button();
            this.label2 = new System.Windows.Forms.Label();
            this.label3 = new System.Windows.Forms.Label();
            this.button6 = new System.Windows.Forms.Button();
            this.button7 = new System.Windows.Forms.Button();
            this.button8 = new System.Windows.Forms.Button();
            this.button9 = new System.Windows.Forms.Button();
            this.SuspendLayout();
            // 
            // DownloadTxt
            // 
            this.DownloadTxt.Location = new System.Drawing.Point(29, 50);
            this.DownloadTxt.Name = "DownloadTxt";
            this.DownloadTxt.Size = new System.Drawing.Size(196, 41);
            this.DownloadTxt.TabIndex = 0;
            this.DownloadTxt.Text = "Download ";
            this.DownloadTxt.UseVisualStyleBackColor = true;
            this.DownloadTxt.Click += new System.EventHandler(this.DownloadTxt_Click);
            // 
            // Salvar
            // 
            this.Salvar.Location = new System.Drawing.Point(308, 51);
            this.Salvar.Name = "Salvar";
            this.Salvar.Size = new System.Drawing.Size(193, 40);
            this.Salvar.TabIndex = 1;
            this.Salvar.Text = "Enviar Arquivo";
            this.Salvar.UseVisualStyleBackColor = true;
            this.Salvar.Click += new System.EventHandler(this.Salvar_Click);
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(52, 20);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(150, 13);
            this.label2.TabIndex = 2;
            this.label2.Text = "Download do Arquivo em TXT";
            this.label2.Click += new System.EventHandler(this.Label2_Click);
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Location = new System.Drawing.Point(309, 20);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(192, 13);
            this.label3.TabIndex = 3;
            this.label3.Text = "Enviar Arquivo para o Banco de Dados";
            // 
            // button6
            // 
            this.button6.Location = new System.Drawing.Point(29, 133);
            this.button6.Name = "button6";
            this.button6.Size = new System.Drawing.Size(196, 41);
            this.button6.TabIndex = 4;
            this.button6.Text = "Download ";
            this.button6.UseVisualStyleBackColor = true;
            this.button6.Click += new System.EventHandler(this.DownloadJson);
            // 
            // button7
            // 
            this.button7.Location = new System.Drawing.Point(308, 133);
            this.button7.Name = "button7";
            this.button7.Size = new System.Drawing.Size(196, 41);
            this.button7.TabIndex = 5;
            this.button7.Text = "Enviar Arquivo Json";
            this.button7.UseVisualStyleBackColor = true;
            this.button7.Click += new System.EventHandler(this.UploadJson);
            // 
            // button8
            // 
            this.button8.Location = new System.Drawing.Point(29, 225);
            this.button8.Name = "button8";
            this.button8.Size = new System.Drawing.Size(196, 41);
            this.button8.TabIndex = 6;
            this.button8.Text = "Download ";
            this.button8.UseVisualStyleBackColor = true;
            this.button8.Click += new System.EventHandler(this.DownloadXML);
            // 
            // button9
            // 
            this.button9.Location = new System.Drawing.Point(308, 225);
            this.button9.Name = "button9";
            this.button9.Size = new System.Drawing.Size(196, 41);
            this.button9.TabIndex = 7;
            this.button9.Text = "Enviar Arquivo XML";
            this.button9.UseVisualStyleBackColor = true;
            this.button9.Click += new System.EventHandler(this.UploadXML);
            // 
            // FormularioParketin
            // 
            this.ClientSize = new System.Drawing.Size(549, 361);
            this.Controls.Add(this.button9);
            this.Controls.Add(this.button8);
            this.Controls.Add(this.button7);
            this.Controls.Add(this.button6);
            this.Controls.Add(this.label3);
            this.Controls.Add(this.label2);
            this.Controls.Add(this.Salvar);
            this.Controls.Add(this.DownloadTxt);
            this.Name = "FormularioParketin";
            this.Text = "Manipulador de Arquivos - Sistema de Integração";
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        private System.Windows.Forms.Button button1;
        private System.Windows.Forms.Button button2;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.Button button3;
        private System.Windows.Forms.Button button4;
        private System.Windows.Forms.Button button5;
        private System.Windows.Forms.Button DownloadTxt;
        private System.Windows.Forms.Button Salvar;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Button button6;
        private System.Windows.Forms.Button button7;
        private System.Windows.Forms.Button button8;
        private System.Windows.Forms.Button button9;
    }
}
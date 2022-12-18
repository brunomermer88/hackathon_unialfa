# hackathon_unialfa

# O banco utilizado no desenvolvimento foi o SQL SERVER, logo abaixo a estrutura das duas tabelas.

USE [academia]
GO

/****** Object:  Table [dbo].[tbl_usuarios]    Script Date: 18/12/2022 19:41:30 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[tbl_usuarios](
	[id] [int] NULL,
	[nome] [nvarchar](max) NULL,
	[cpf] [nvarchar](100) NULL,
	[data_nascimento] [date] NULL,
	[altura] [numeric](19, 2) NULL,
	[tipo] [nvarchar](50) NULL,
	[password] [nvarchar](50) NULL,
	[email] [nvarchar](50) NULL
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

/****** Object:  Table [dbo].[tbl_imcs_cadastrados]    Script Date: 18/12/2022 19:42:45 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[tbl_imcs_cadastrados](
	[id] [int] NULL,
	[dataCadastro] [datetime] NULL,
	[idAluno] [int] NULL,
	[idProfessor] [int] NULL,
	[imc] [numeric](19, 2) NULL,
	[peso] [numeric](19, 2) NULL
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[tbl_imcs_cadastrados] ADD  CONSTRAINT [DF_tbl_imcs_cadastrados_dataCadastro]  DEFAULT (getdate()) FOR [dataCadastro]
GO


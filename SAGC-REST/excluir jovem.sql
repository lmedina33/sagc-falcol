SELECT * FROM Jovem WHERE nome = "LUCAS DE OLIVEIRA REZENDE DUPLICIDADE"
DELETE FROM Jovem WHERE id="3426"

DELETE FROM HistoricoSelecao WHERE jovem_id = "3426";
DELETE FROM JovemNucleo WHERE jovem_id = "3426";
DELETE FROM RespostaSelecao WHERE jovem_id = "3426";
DELETE FROM Frequencia WHERE jovem_id = "3426";
DELETE FROM Avaliacao WHERE jovem_id = "3426";
-- Xóa Điều tiết giá vé
--
-- usp_deleteRegulation 'DT2011'

Create Procedure usp_deleteRegulation
	@id nchar(10)
As
Begin
	Delete From DieuTietGiaVe Where MaDT = @id
End
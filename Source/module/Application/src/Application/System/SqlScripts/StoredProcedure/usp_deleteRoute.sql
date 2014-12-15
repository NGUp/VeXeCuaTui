-- xóa một Lịch trình
--
-- usp_deleteRoute 'A08C44F'

Create Procedure usp_deleteRoute
	@id nchar(10)
As
Begin
	Delete From LichTrinh Where MaLT = @id
End
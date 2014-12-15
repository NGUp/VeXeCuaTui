-- Xóa Quản trị viên
--
-- usp_deleteManager '025022111'

Create Procedure usp_deleteManager
	@id nchar(10)
As
Begin
	Delete From QuanTriVien
	Where CMND = @id
End
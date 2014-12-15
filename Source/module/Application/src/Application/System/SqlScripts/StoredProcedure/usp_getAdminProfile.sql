-- Lấy thông tin của Quản trị viên
--
-- usp_getAdminProfile '025022111'

Create Procedure usp_getAdminProfile
	@id nchar(10)
As
Begin
	Select CMND, HoTen, TenDangNhap, QuanTriVien, HangXe
	From QuanTriVien
	Where CMND = @id
End
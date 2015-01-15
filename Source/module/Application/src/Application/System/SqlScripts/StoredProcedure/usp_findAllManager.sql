-- Xuất danh sách các quản trị viên phân quyền Moderator
--
-- exec usp_findAllManager

Create Procedure usp_findAllManager
As
Begin
	Select qtl.CMND, qtl.HoTen, qtl.TenDangNhap, qtl.QuanTriVien, hx.TenHangXe
	From QuanTriVien qtl Left Join HangXe hx on qtl.HangXe = hx.MaHangXe
	Where qtl.QuanTriVien = 'False'
End
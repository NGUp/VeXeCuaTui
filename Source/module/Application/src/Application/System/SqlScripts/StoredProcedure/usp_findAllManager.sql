-- Xuất danh sách các quản trị viên bao gồm Administrator và Moderator
--
-- exec usp_findAllManager

Create Procedure usp_findAllManager
As
Begin
  Select qtv.CMND, qtv.HoTen, qtv.TenDangNhap, qtv.QuanTriVien, hx.TenHangXe
	From QuanTriVien qtv Left Join HangXe hx on qtv.HangXe = hx.MaHangXe
End
Go
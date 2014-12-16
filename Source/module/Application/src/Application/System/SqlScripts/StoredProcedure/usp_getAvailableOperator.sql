-- Lay danh sach cac hang xe chua co Moderator
--
-- usp_getAvailableOperator

Create Procedure usp_getAvailableOperator
As
Begin
	Select hx.MaHangXe, hx.TenHangXe
	From (	Select MaHangXe
			From HangXe
			Except
			Select HangXe From QuanTriVien) As HangXeMoi
		Join HangXe hx on HangXeMoi.MaHangXe = hx.MaHangXe
End
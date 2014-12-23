-- Lấy danh sach 63 tỉnh thành
-- usp_getAllProvinces

Create Procedure usp_getAllProvinces
As
Begin
	Select MaTinh, TenTinh
	From TinhThanh
End
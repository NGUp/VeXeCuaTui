-- Lấy danh sách xe theo hãng
--
-- usp_getAllCars 'FUTA'

Create Procedure usp_getAllCars
	@operator nchar(10)
As
Begin
	Select xe.BangSoXe, loai.TenLoai, hang.TenHangXe, lich.NoiDi, lich.NoiDen
	From (Xe xe join LichTrinh lich On xe.LichTrinh = lich.MaLT) join LoaiXe loai on xe.LoaiXe = loai.MaLoai, HangXe hang
	WHere hang.MaHangXe = @operator
End
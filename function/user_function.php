<?php
  // ランダムな文字列を生成する関数
  function randomStr($len) {
    return substr(base_convert(md5(uniqid()), 16, 36), 0, $len);
  }

    //    空白置換をする関数
  function space_replacement($str) {
    $target = array(' ', '　');
  //      全角半角スペースを削除する
    str_replace($target, '', $str);
    return $str;
  }

  // ハッシュ化する関数
  function hash256($pw, $salt) {
    return hash('sha256', $pw . $salt);
  }

  //    文字数チェックをする関数
  function length_validation($str, $max, $min) {
  //    文字数カウント
    $str = mb_strlen($str, "UTF-8");

    return $str <= $max && $str >= $min;
  }

//    メールのバリデーションチェックをする関数
  function mail_validation($mail) {
  //      空白を削除
    $mail =
    space_replacement($mail);
  //      5文字以上、64文字以内であるか
    if (
      length_validation($mail, 256, 5)) {
  //   行頭が英数字の1文字以上でかつ「＠」マークの後、英字「.」英字の形式であるか 例1※a@a.a 例2※01.Sample_Mail-DaNyo@Abc.deF
      if (preg_match("/^([a-zA-Z\d])+([a-zA-Z\d._-])*@([a-zA-Z])+((\.)+([a-zA-Z]+))+$/", $mail)) {
        return true;
      } else {
        return false;
      }
    // 文字数が足りない
    } else {
      return false;
    }
  }

//    パスワードのバリデーションチェックをする関数
  function pw_validation($pw) {
//      空白を削除
    $pw =
      space_replacement($pw);
//     8文字以上、50文字以内であるか
    if (
      length_validation($pw, 50, 8)) {
//        半角英小文字大文字数字をそれぞれ1種類以上含んでいるか
      if (preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*[\d])[a-zA-Z0-9.?\/-@]{8,50}$/", $pw)) {
        return true;
      } else {
        return false;
      }
    }
  }  

  //    名前のバリデーションチェックをする関数
  function name_validation($name): bool {
//     1文字以上、32文字以内であるか
//    空白を削除
    $name = space_replacement($name);
    if (
      length_validation($name, 32, 1)) {
      return true;
    } else {
      return false;
    }
  }




<?php

$arg_copy = array_values($argv);
unset($arg_copy[0]);

$editor = "C:/Program Files (x86)/MarkdownPad 2/MarkdownPad2.exe";

$judul = implode(' ', array_values($arg_copy));

$sep = '==';
$cat = false;

if (strpos($judul, $sep) !== false) {
  $parts = explode($sep, $judul, 2);
  $cat = $parts[0];
  $judul = $parts[1];
}

$nama_file = slugify($judul);
$tanggal = date('Y-m-d');
$path = "_posts/{$tanggal}-{$nama_file}.md";
if ($cat == 'page') {
  $path = "{$nama_file}.md";
} else if ($cat) {
  $path = "{$cat}/_posts/{$tanggal}-{$nama_file}.md";
  $dir = "{$cat}/_posts";
  if (!file_exists($dir)) {
    mkdir($dir, 0777, true);
  }
}

if (file_exists($path)) {
  echo "{$path} already exists\n";
  exit(1);
}

echo "Creating {$path}...\n";

$isi = "---\n";
$isi .= "title: \"{$judul}\"\n";

if ($cat != 'page') {
  $isi .= "date: " . date('Y-m-d H:i:s O') . "\n";
  $isi .= "source_url: \n";
  
  if ($cat == 'projects') {
    $isi .= "project_title: \n";
    $isi .= "project_desc: \n";
  } else {
    $isi .= "tags:\n";
    $isi .= " - \n";
  }
  
  if ($cat) {
    $isi .= "permalink: /{$cat}/{$nama_file}.html\n";
  }
}

$isi .= "---\n";

file_put_contents($path, $isi);

pclose(popen('start /b "' . $editor . '" "' . realpath($path) . '"', 'r'));

echo "DONE!\n";

exit(0);

function slugify($text) { 
  // replace non letter or digits by -
  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

  // trim
  $text = trim($text, '-');

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // lowercase
  $text = strtolower($text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}
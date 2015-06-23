require "stringex"
class Jekyll < Thor
	desc "new", "create a new post"
	method_option :editor, :default => "C:/Program Files (x86)/MarkdownPad 2/MarkdownPad2.exe"
	def new(*title)
		title = title.join(" ")
		date = Time.now.strftime('%Y-%m-%d')
		filename = "_posts/#{date}-#{title.to_url}.md"
		
		sep = "=="
		cat = ""
		
		if title.include?(sep)
			cat = title.split(sep, 2).first.strip
			title = title.split(sep, 2).last.strip
			
			if cat == "page"
				filename = "#{title.to_url}.md"
			else
				filename = "#{cat}/_posts/#{date}-#{title.to_url}.md"
				dirname = "#{cat}/_posts/"
				
				unless File.directory?(dirname)
					FileUtils.mkdir_p(dirname)
				end
			end
		else
			filename = "_posts/#{date}-#{title.to_url}.md"
		end

		if File.exist?(filename)
			abort("#{filename} already exists!")
		end

		puts "Creating new post: #{filename}"
		open(filename, 'w') do |post|
			post.puts "---"
			if cat == "page"
				post.puts "title: \"#{title.gsub(/&/,'&amp;')}\""
			else
				if cat == "projects"
					post.puts "title: \"Project: #{title.gsub(/&/,'&amp;')}\""
					post.puts "source_url: "
					post.puts "project_title: "
					post.puts "project_desc: "
				else
					post.puts "title: \"#{title.gsub(/&/,'&amp;')}\""
					post.puts "source_url: "
					post.puts "tags:"
					post.puts " - "
				end
				post.puts "date: #{Time.now.strftime('%Y-%m-%d %H:%M:%S')}"
			end
			post.puts "---"
			post.puts ""
		end

		system(options[:editor], filename)
	end
end
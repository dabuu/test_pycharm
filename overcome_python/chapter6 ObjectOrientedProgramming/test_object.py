# -*- encoding:utf-8 -*-
__author__ = 'dabuwang'

print "========== basic usage ============";

class person(object):
    # 公有属性
    name = "";
    age = 0;
    # 私有属性  双下划线
    __gender = "man";

    def __init__(self, name, age):
        self.name = name;
        self.age = age;

    # 无参 方法
    def sayhi(self):
        print ("hi " + self.__gender +"," + self.name);

    # 有参 方法
    def setage(self, age):
        self.__ismanaga(age);

    # 私有方法
    def __ismanaga(self,age):
        if(age > 150):
            print "are you human?";
        else:
            self.age = age;

class Student(person):

    grade = 1;

    def __init__(self,name, age, grade):
        person.__init__(self, name, age);
        # super(Student, self).__init__(name, age);
        self.grade = grade;

    def showpersoninfo(self):
        print "name: "+self.name + "; & age: " + str(self.age);


mm = Student("nb", 11,2);
print mm.name;

mm.setage(200)

# module = student("nb", 11);
# module.showpersoninfo();

# cary = person("2huo", 100);
#
# cary.sayhi();
#
# cary.setage(200);
